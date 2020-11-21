<?php declare(strict_types=1);

namespace App\Domain;

class DiscountRule implements \JsonSerializable
{
    public string $sku;
    public int $quantity;

    public function __construct(string $sku, int $quantity)
    {
        $this->sku = $sku;
        $this->quantity = $quantity;
    }

    public function jsonSerialize(): array
    {
        return [
            'sku' => $this->sku,
            'quantity' => $this->quantity,
        ];
    }
}