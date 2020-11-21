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
     * @var DiscountRule[]
     */
    public array $discounts;
}
