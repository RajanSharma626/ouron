<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function toggleWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = Auth::id();
        $productId = $request->product_id;

        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);
            return response()->json(['status' => 'added']);
        }
    }

    public function getWishlist()
    {
        $wishlist = Wishlist::with([
            'product.firstimage',
            'product.secondimage'
        ])->where('user_id', Auth::id())->get();

        return view('frontend.wishlist', compact('wishlist'));
    }

    public function adminWishlist()
    {
        $wishlistData = Wishlist::select(
            'products.id',
            'products.name',
            DB::raw('COUNT(wishlists.id) as total_wishlist_count'),
            'first_img.img as product_image'
        )
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->leftJoin('product_img as first_img', function ($join) {
                $join->on('products.id', '=', 'first_img.product_id')
                    ->where('first_img.is_main', true); // Fetch main image
            })
            ->groupBy('products.id', 'products.name', 'first_img.img')
            ->paginate(20);

        return view('admin.wishlist', compact('wishlistData'));
    }

    public function adminWishlistLiked($id)
    {

        $users = User::whereHas('wishlist', function ($query) use ($id) {
            $query->where('product_id', $id);
        })->with('defaultAddress')->paginate(15);

        return view('admin.wishlist-users', compact('users', "id"));
    }

    public function downloadCSV($id)
    {
        $product = Product::findOrFail($id);

        $users = User::whereHas('wishlist', function ($query) use ($id) {
            $query->where('product_id', $id);
        })->with('defaultAddress')->get();

        $csvFileName = str_replace(' ', '_', $product->name) ."_wishlist". '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://temp', 'r+');

        // CSV headers
        fputcsv($handle, ['Name', 'Email', 'Phone', 'Address', 'Joined']);

        foreach ($users as $user) {
            $address = $user->defaultAddress
                ? $user->defaultAddress->address . ' ' . $user->defaultAddress->address_2 . ', ' . $user->defaultAddress->city . ', ' . $user->defaultAddress->state . ', ' . $user->defaultAddress->pin_code
                : 'N/A';

            fputcsv($handle, [
                $user->name,
                $user->email ?? 'N/A',
                $user->phone,
                $address,
                $user->created_at->toDateString(),
            ]);
        }

        rewind($handle);

        return response()->stream(
            function () use ($handle) {
                fpassthru($handle);
            },
            200,
            $headers
        );
    }
}
