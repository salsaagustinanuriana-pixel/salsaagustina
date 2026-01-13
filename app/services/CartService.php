<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Exception;

class CartService
{
    /**
     * Ambil cart user (PASTI ADA)
     */
    public function getCart(): Cart
    {
        if (!Auth::check()) {
            throw new Exception('User belum login');
        }

        return Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Tambah produk ke cart
     */
    public function addProduct(Product $product, int $quantity): void
    {
        $cart = $this->getCart();

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'quantity'   => $quantity,
            ]);
        }
    }

    /**
     * Update quantity item
     */
    public function updateQuantity(int $itemId, int $quantity): void
    {
        $item = CartItem::findOrFail($itemId);

        $cart = $this->getCart();
        $this->verifyCartOwnership($cart);

        if ($quantity <= 0) {
            $item->delete();
            return;
        }

        $item->quantity = $quantity;
        $item->save();
    }

    /**
     * Hapus item dari cart
     */
    public function removeItem(int $itemId): void
    {
        $item = CartItem::findOrFail($itemId);

        $cart = $this->getCart();
        $this->verifyCartOwnership($cart);

        $item->delete();
    }

    /**
     * VALIDASI CART PUNYA USER
     */
    private function verifyCartOwnership(Cart $cart): void
    {
        if ($cart->user_id !== Auth::id()) {
            throw new Exception('Akses cart tidak sah');
        }
    }
}
