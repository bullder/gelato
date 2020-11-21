<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Sku;
use App\Domain\SkuRepository;

class InMemorySkuRepository implements SkuRepository
{
    /**
     * @var Sku[]
     */
    private array $skus;

    public function __construct(array $skus = null)
    {
        $this->skus = $skus ?? [
                new Sku('A', 50),
                new Sku('B', 30),
                new Sku('C', 20),
                new Sku('D', 15),
            ];
    }

    public function findAll(): array
    {
        return array_values($this->skus);
    }
}
