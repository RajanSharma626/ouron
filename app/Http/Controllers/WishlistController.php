<?php

namespace App\Http\Controllers;

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
        $wishlist = Wishlist::where('wishlists.user_id', Auth::id())
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->leftJoin('product_img as first_img', function ($join) {
                $join->on('products.id', '=', 'first_img.product_id')
                    ->where('first_img.is_main', true); // Fetch main image
            })
            ->leftJoin('product_img as second_img', function ($join) {
                $join->on('products.id', '=', 'second_img.product_id')
                    ->where('second_img.is_main', false); // Fetch secondary image (hover image)
            })
            ->get([
                'products.*',
                'first_img.img as product_image',
                'second_img.img as hover_image'
            ]);

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
}
