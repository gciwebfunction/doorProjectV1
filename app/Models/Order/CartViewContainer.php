<?php

namespace App\Models\Order;

use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;

class CartViewContainer
{
    private $doorViewObjects;

    private $cartItemCount;

    private $orderSubtotal;

    private $orderDiscount;

    private $orderTax;

    private $orderTaxRate;

    private $orderDiscountRate;

    private $orderTotal;

    public function __construct()
    {
        $this->doorViewObjects = [];
        $this->cartItemCount = 0;
        $this->orderTotal = 0;
        $this->orderSubtotal = 0;
        $this->orderDiscount = 0;
        $this->orderTax = 0;
        $this->orderTaxRate = 0;
        $this->orderDiscountRate = 0;
    }

    /**
     * @return array
     */
    public function getDoorViewObjects(): array
    {
        return $this->doorViewObjects;
    }

    /**
     * @param array $doorViewObjects
     */
    public function setDoorViewObjects(array $doorViewObjects): void
    {
        $this->doorViewObjects = $doorViewObjects;
    }

    /**
     * @return int
     */
    public function getCartItemCount(): int
    {
        return $this->cartItemCount;
    }

    /**
     * @param int $cartItemCount
     */
    public function setCartItemCount(int $cartItemCount): void
    {
        $this->cartItemCount = $cartItemCount;
    }

    /**
     * @return int
     */
    public function getOrderSubtotal(): int
    {
        return $this->orderSubtotal;
    }

    /**
     * @param int $orderSubtotal
     */
    public function setOrderSubtotal(int $orderSubtotal): void
    {
        $this->orderSubtotal = $orderSubtotal;
    }

    /**
     * @return int
     */
    public function getOrderDiscount(): int
    {
        return $this->orderDiscount;
    }

    /**
     * @param int $orderDiscount
     */
    public function setOrderDiscount(int $orderDiscount): void
    {
        $this->orderDiscount = $orderDiscount;
    }

    /**
     * @return int
     */
    public function getOrderTax(): int
    {
        return $this->orderTax;
    }

    /**
     * @param int $orderTax
     */
    public function setOrderTax(int $orderTax): void
    {
        $this->orderTax = $orderTax;
    }

    /**
     * @return int
     */
    public function getOrderTaxRate(): int
    {
        return $this->orderTaxRate;
    }

    /**
     * @param int $orderTaxRate
     */
    public function setOrderTaxRate(int $orderTaxRate): void
    {
        $this->orderTaxRate = $orderTaxRate;
    }

    /**
     * @return int
     */
    public function getOrderDiscountRate(): int
    {
        return $this->orderDiscountRate;
    }

    /**
     * @param int $orderDiscountRate
     */
    public function setOrderDiscountRate(int $orderDiscountRate): void
    {
        $this->orderDiscountRate = $orderDiscountRate;
    }

    /**
     * @return int
     */
    public function getOrderTotal(): int
    {
        return $this->orderTotal;
    }

    /**
     * @param int $orderTotal
     */
    public function setOrderTotal(int $orderTotal): void
    {
        $this->orderTotal = $orderTotal;
    }

    public function addDoorViewItem($key, $value)
    {
        $this->doorViewObjects[$key] = $value;
    }

}
