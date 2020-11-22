<?php declare(strict_types=1);


namespace App\Infrastructure\Persistence;

use App\Domain\Discount;
use App\Domain\DiscountRepository;
use App\Domain\DiscountRule;
use App\Domain\DomainException\DiscountNotFoundException;

class InMemoryDiscountRepository implements DiscountRepository
{
    /**
     * @var Discount[]
     */
    private array $discounts;

    public function __construct(array $discounts = null)
    {
        $this->discounts = $discounts ?? [
                0 => new Discount('3A for $130', 20, new DiscountRule(0, 'A', 3)),
                1 => new Discount('2B for $45', 15, new DiscountRule(0, 'B', 2)),
                2 => new Discount('$10 of total $200', 10, new DiscountRule(200)),
            ];
    }

    public function findAll(): array
    {
        return array_values($this->discounts);
    }
    /**
     * @throws DiscountNotFoundException
     */
    public function byId(int $id): Discount
    {
        if (!isset($this->discounts[$id])) {
            throw new DiscountNotFoundException();
        }

        return $this->discounts[$id];
    }
}
