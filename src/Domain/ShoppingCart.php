<?php declare(strict_types=1);

namespace App\Domain;

class ShoppingCart
{
    public int $total = 0;

    /**
     * @var Sku[]
     */
    public array $skus;

    /**
     * @var Discount[]
     */
    public array $discounts;

    public function __construct(array $skus = [], array $discounts = [])
    {
        $this->skus = $skus;
        $this->discounts = $discounts;
    }

    public function addSku(Sku $sku): ShoppingCart
    {
        $this->skus[] = $sku;

        return $this;
    }

    public function addDiscount(Discount $discount): ShoppingCart
    {
        $this->discounts[] = $discount;

        return $this;
    }

    public function getTotal(): int
    {
        $this->total = 0;
        foreach ($this->skus as $sku) {
            $this->total += $sku->price;
        }

        foreach ($this->discounts as $discount) {
            $this->total -= $discount->amount;
        }

        return $this->total;
    }
}
