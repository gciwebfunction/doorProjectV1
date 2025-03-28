<?php

namespace App\Service;

use App\Models\Order\ShoppingCart;

class CartService
{

    /**
     * @param $id - The user id associated with the cart.
     * @return ShoppingCart - A ShoppingCart object.
     */
    public function getUserCart($id): ShoppingCart
    {
        $shoppingCart = ShoppingCart::where('user_id', $id)
            ->where('is_active', 1)->first();
        if (isset($shoppingCart)) {
            return $shoppingCart;
        }
        //echo
        $shoppingCart = new ShoppingCart();
        $shoppingCart->user_id = $id;
        $shoppingCart->is_active = 1;

        $shoppingCart->save();

        return $shoppingCart;
    }

    public function clearUserCart($user)
    {
        $cart = $this->getUserCart($user->id);

        $cart->update(['is_active'=>0]);
    }

}
