<?php declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Checkout;
use App\Domain\SkuRepository;
use Psr\Http\Message\ServerRequestInterface as Request;

class CheckoutBuilder implements CheckoutBuilderInterface
{
    public const SKUS_PARAM_NAME = 'skus';

    protected SkuRepository $repository;
    protected ShoppingCartProcessorInterface $processor;

    public function __construct(SkuRepository $repository, ShoppingCartProcessor $processor)
    {
        $this->repository = $repository;
        $this->processor = $processor;
    }

    public function build(Request $request): Checkout
    {
        $checkout = new Checkout();
        $checkout->skus = $this->repository->findAll();

        $skus = explode(',', $request->getAttribute(self::SKUS_PARAM_NAME, ''));
        if (!count($skus)) {
            return $checkout;
        }

//        foreach ($skus as $sku) {
//            $checkout->cart->addSku(
//                $this->repository->byId($sku)
//            );
//        }

        $checkout->cart = $this->processor->process($checkout->cart);

        return $checkout;
    }
}