<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Add item to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric'
        ]);

        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        // Check if item exists in cart
        $cartItem = CartItem::where('session_id', $sessionId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $request->product_id,
                'quantity' => 1,
                'price' => $request->price
            ]);
        }

        return response()->json(['message' => 'Item added to cart']);
    }

    // Get cart items
    public function getCart()
    {
        $sessionId = session()->getId();
        $cartItems = CartItem::where('session_id', $sessionId)->with(['product', 'product.firstimage'])->get();
        return response()->json($cartItems);
    }

    // Update quantity
    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        CartItem::where('id', $request->cart_id)->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart updated']);
    }

    // Delete cart item
    public function deleteCartItem($id)
    {
        CartItem::where('id', $id)->delete();
        return response()->json(['message' => 'Item removed']);
    }
}
