<?php declare(strict_types=1);


namespace App\Infrastructure\Persistence;

use App\Domain\Discount;
use App\Domain\DiscountRule;
use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;

class InMemoryDiscountRepository
{
    /**
     * @var Discount[]
     */
    private array $discounts;

    public function __construct(array $users = null)
    {
        $this->discounts = $users ?? [
                new Discount('3A for $130', 30, new DiscountRule(0, 'A', 3)),
                new Discount('2B for $130', 15, new DiscountRule(0, 'B', 2)),
                new Discount('$10 of total $200', 10, new DiscountRule(200)),
            ];
    }

    public function findAll(): array
    {
        return array_values($this->discounts);
    }
}