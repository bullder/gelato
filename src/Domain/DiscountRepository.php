<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain;

interface DiscountRepository
{
    /**
     * @return Discount[]
     */
    public function findAll(): array;
}
