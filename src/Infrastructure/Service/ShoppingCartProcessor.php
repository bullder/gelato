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
            $isApplicable = $this->isApplicable($discount, $cart);
            while ($isApplicable > 0) {
                $cart->addDiscount($discount);
                $cart->updateTotal();
                $isApplicable--;
            }
        }

        return $cart;
    }

    private function isApplicable(Discount $discount, ShoppingCart $cart): int
    {
        if (null === $discount->rule->sku && $cart->getTotal() >= $discount->rule->total) {
            return 1;
        }

        if ($discount->rule->sku) {
            $discountedItem = $cart->getItemBySku($discount->rule->sku);
            if ($discountedItem && $discountedItem->quantity >= $discount->rule->quantity) {
                return intdiv($discountedItem->quantity, $discount->rule->quantity);
            }
        }

        return 0;
    }
}