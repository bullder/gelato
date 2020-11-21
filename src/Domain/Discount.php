<?php declare(strict_types=1);


namespace App\Domain;


class Discount
{
    public string $name;
    public int $amount;
    public ?DiscountRule $rule;

    public function __construct(string $name, int $amount) {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'price' => $this->amount,
        ];
    }
}