<?php declare(strict_types=1);

namespace Tests\Infrastructure\Persistence;

use App\Domain\DomainException\SkuNotFoundException;
use App\Domain\Sku;
use App\Infrastructure\Persistence\InMemorySkuRepository;
use Tests\TestCase;

class InMemorySkuRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $skus = [
            new Sku('A', 50),
            new Sku('B', 30),
            new Sku('C', 20),
            new Sku('D', 15),
        ];
        $userRepository = new InMemorySkuRepository($skus);

        $this->assertEquals($skus, $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $skus = [
            'A' => new Sku('A', 50),
            'B' => new Sku('B', 30),
            'C' => new Sku('C', 20),
            'D' => new Sku('D', 15),
        ];

        $userRepository = new InMemorySkuRepository();

        $this->assertEquals(array_values($skus), $userRepository->findAll());
    }

    public function testById()
    {
        $sku = new Sku('A', 50);

        $userRepository = new InMemorySkuRepository(['A' => $sku]);

        $this->assertEquals($sku, $userRepository->byId('A'));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $repository = new InMemorySkuRepository([]);
        $this->expectException(SkuNotFoundException::class);
        $repository->byId('Z');
    }
}
