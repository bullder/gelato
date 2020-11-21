<?php declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Discount;
use App\Domain\DiscountRepository;
use App\Domain\ShoppingCart;

class ShoppingCartProcessor implements ShoppingCartProcessorInterface
{
    /**
     * @var Discount[]
     */
    protected array $discounts;

    public function __construct(DiscountRepository $repository)
    {
        $this->discounts = $repository->findAll();
    }

    public function process(ShoppingCart $cart): ShoppingCart
    {
        $cart->discounts = [];
        $cart->updateTotal();

        foreach ($this->discounts as $discount) {
            if ($this->isApplicable($discount, $cart)) {
                $cart->addDiscount($discount);
                $cart->updateTotal();
            }
        }

        return $cart;
    }

    private function isApplicable(Discount $discount, ShoppingCart $cart): bool
    {
        if (null === $discount->rule->sku) {
            return $cart->getTotal() >= $discount->rule->total;
        }

        $discountedItem = $cart->getItemBySku($discount->rule->sku);
        if ($discountedItem) {
            return $discountedItem->quantity >= $discount->rule->quantity;
        }

        return false;
    }
}