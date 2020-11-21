<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain;

interface SkuRepository
{
    /**
     * @return Sku[]
     */
    public function findAll(): array;
}
