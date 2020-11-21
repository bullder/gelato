<?php declare(strict_types=1);

namespace App\Domain;

class Item
{
    public int $quantity;
    public Sku $sku;

    public function __construct(Sku $sku, int $quantity = 1)
    {
        $this->quantity = $quantity;
        $this->sku = $sku;
    }

    public function addQuantity(): Item
    {
        $this->quantity++;

        return $this;
    }

    public function getTotal(): int
    {
        return $this->quantity * $this->sku->price;
    }
}
