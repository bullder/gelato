<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\DomainException\SkuNotFoundException;
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
                'A' => new Sku('A', 50),
                'B' => new Sku('B', 30),
                'C' => new Sku('C', 20),
                'D' => new Sku('D', 15),
            ];
    }

    public function findAll(): array
    {
        return array_values($this->skus);
    }

    /**
     * @throws SkuNotFoundException
     */
    public function byId(string $id): Sku
    {
        if (!isset($this->skus[$id])) {
            throw new SkuNotFoundException();
        }

        return $this->skus[$id];
    }
}
