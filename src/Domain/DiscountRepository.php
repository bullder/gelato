<?php declare(strict_types=1);

namespace App\Domain;

interface DiscountRepository
{
    /**
     * @return Discount[]
     */
    public function findAll(): array;

    public function byId(int $id): Discount;
}
