<?php declare(strict_types=1);

namespace Tests\Infrastructure\Service;

use App\Infrastructure\Persistence\InMemoryDiscountRepository;
use App\Infrastructure\Persistence\InMemorySkuRepository;
use App\Infrastructure\Service\CheckoutBuilder;
use App\Infrastructure\Service\ShoppingCartProcessor;
use Tests\TestCase;

class CheckoutBuilderTest extends TestCase
{
    private CheckoutBuilder $builder;

    public function setUp(): void
    {
        $this->builder = new CheckoutBuilder(
            new InMemorySkuRepository(),
            new ShoppingCartProcessor(
                new InMemoryDiscountRepository()
            )
        );
    }

    /**
     * @dataProvider buildProvider
     */
    public function testBuild(string $cart, int $total, int $itemCount)
    {
        $view = $this->builder->build($cart);

        $this->assertEquals($total, $view->cart->getTotal());
        $this->assertCount($itemCount, $view->cart->items);
    }

    public function buildProvider(): array
    {
        return [
            'three sku without discounts' => [
                'D,C,B',
                65,
                3
            ],
            '3A for $130 discount' => [
                'A,A,A',
                130,
                1
            ],
            '2B for $45' => [
                'B,B',
                45,
                1
            ],
            '$10 of total $200' => [
                'A,A,A,B,C,D',
                195,
                4
            ],
        ];
    }
}