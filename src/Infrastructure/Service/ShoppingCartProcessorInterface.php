<?php declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\ShoppingCart;

interface ShoppingCartProcessorInterface
{
    public function process(ShoppingCart $cart): ShoppingCart;
}
