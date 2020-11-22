<?php declare(strict_types=1);

namespace Tests\Infrastructure\Persistence;

use App\Domain\Discount;
use App\Domain\DiscountRule;
use App\Domain\DomainException\DiscountNotFoundException;
use App\Infrastructure\Persistence\InMemoryDiscountRepository;
use Tests\TestCase;

class InMemoryDisountRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $discounts = [
            new Discount('3A for $130', 20, new DiscountRule(0, 'A', 3)),
            new Discount('2B for $45', 15, new DiscountRule(0, 'B', 2)),
            new Discount('$10 of total $200', 10, new DiscountRule(200)),
        ];
        $userRepository = new InMemoryDiscountRepository($discounts);

        $this->assertEquals($discounts, $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $discounts = [
            0 => new Discount('3A for $130', 20, new DiscountRule(0, 'A', 3)),
            1 => new Discount('2B for $45', 15, new DiscountRule(0, 'B', 2)),
            2 => new Discount('$10 of total $200', 10, new DiscountRule(200)),
        ];

        $userRepository = new InMemoryDiscountRepository();

        $this->assertEquals(array_values($discounts), $userRepository->findAll());
    }

    public function testById()
    {
        $discount = new Discount('3A for $130', 20, new DiscountRule(0, 'A', 3));

        $userRepository = new InMemoryDiscountRepository([$discount]);

        $this->assertEquals($discount, $userRepository->byId(0));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $repository = new InMemoryDiscountRepository([]);
        $this->expectException(DiscountNotFoundException::class);
        $repository->byId(1337);
    }
}
