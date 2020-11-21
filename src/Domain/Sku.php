<?php declare(strict_types=1);

namespace App\Domain;

use JsonSerializable;

class Sku implements JsonSerializable
{
    public string $name;
    public int $price;

    public function __construct(string $name, int $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
}
