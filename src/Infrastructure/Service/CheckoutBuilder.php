<?php declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Checkout;
use App\Domain\SkuRepository;

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

    public function build(string $cartString): Checkout
    {
        $checkout = new Checkout();
        $checkout->skus = $this->repository->findAll();

        $skus = array_filter(
            explode(',', $cartString),
            'strlen'
        );

        if (!count($skus)) {
            return $checkout;
        }

        foreach ($skus as $sku) {
            $checkout->cart->addSku(
                $this->repository->byId($sku)
            );
        }

        $checkout->cart = $this->processor->process($checkout->cart);

        return $checkout;
    }
}
