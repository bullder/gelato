<?php declare(strict_types=1);

namespace App\Domain;

interface SkuRepository
{
    /**
     * @return Sku[]
     */
    public function findAll(): array;

    public function byId(string $id): Sku;
}
