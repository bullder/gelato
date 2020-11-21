<?php declare(strict_types=1);

namespace App\Domain;

class Checkout
{
    /**
     * @var Sku[]
     */
    public array $skus;

    public ShoppingCart $cart;

    public function __construct()
    {
        $this->skus = [];
        $this->cart = new ShoppingCart();
    }
}
