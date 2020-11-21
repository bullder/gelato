<?php declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Checkout;
use Psr\Http\Message\ServerRequestInterface as Request;

interface CheckoutBuilderInterface
{
    public function build(Request $request): Checkout;
}