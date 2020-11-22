<?php declare(strict_types=1);

namespace App\Domain;

class DiscountRule
{
    public ?string $sku;
    public ?int $quantity;
    public int $total;

    public function __construct(int $total = 0, ?string $sku = null, ?int $quantity = null)
    {
        $this->total = $total;
        $this->sku = $sku;
        $this->quantity = $quantity;
    }
}