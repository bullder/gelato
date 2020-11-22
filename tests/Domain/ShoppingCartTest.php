<?php declare(strict_types=1);

namespace Tests\Domain;

use App\Domain\ShoppingCart;
use App\Domain\Sku;
use Tests\TestCase;

class ShoppingCartTest extends TestCase
{
    public function testSlug()
    {
        $cart = new ShoppingCart();
        $cart->addSku(new Sku('TEST2', 20));

        $this->assertEquals($cart->getUrlForSku(new Sku('TEST', 10)), '/?skus=TEST,TEST2');
    }
}
