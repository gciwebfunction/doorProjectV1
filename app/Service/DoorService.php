<?php

namespace App\Service;

use App\Http\Controllers\Product\ProductUtility;
use App\Models\Order\CartViewContainer;

class DoorService
{


    public function getDoorViewObjectsForCart($shoppingCart): CartViewContainer
    {

        $ProductUtility = new ProductUtility();

        $cartView       = new CartViewContainer();

        if (isset($shoppingCart)) {
            $cartItems = $shoppingCart->doorItems;



            foreach ($cartItems as $key => $cartItem) {

                    //foreach ($cartItem->doorItemModifiers as $modifier):
                    //echo '<pre>';var_dump($cartItem);echo '</pre>';die;

                //$cartView->addDoorViewItem($key, ProductUtility::getViewItem($cartItem));
                $cartView->addDoorViewItem($key, $ProductUtility->getViewItem($cartItem));
                //$cartView->setOrderSubtotal($cartView->getOrderSubtotal() + $cartView->getDoorViewObjects()[$key]->getPrice());
                $cartView->setOrderSubtotal($cartView->getOrderSubtotal() + ($cartView->getDoorViewObjects()[$key]->getPrice() * $cartView->getDoorViewObjects()[$key]->getQuantity()));
                $cartView->setCartItemCount($cartView->getCartItemCount() + 1);
            }

            $cartView->setOrderDiscount($cartView->getOrderSubtotal() * $cartView->getOrderDiscountRate());
            $cartView->setOrderTax($cartView->getOrderSubtotal() * $cartView->getOrderTaxRate());
            $cartView->setOrderTotal($cartView->getOrderSubtotal() * $cartView->getOrderTax() + $cartView->getOrderDiscount());

        }

        return $cartView;
    }
}
