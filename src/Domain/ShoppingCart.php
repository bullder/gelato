<?php declare(strict_types=1);

namespace App\Domain;

class ShoppingCart
{
    public int $total = 0;

    /**
     * @var Item[]
     */
    public array $items = [];

    /**
     * @var Discount[]
     */
    public array $discounts = [];

    public function addSku(Sku $sku): ShoppingCart
    {
        if (!$this->hasSkuItem($sku)) {
            $this->items[] = new Item($sku);

            return $this;
        }

        return $this->increaseQuantityForSkuItem($sku);
    }

    public function hasSkuItem(Sku $sku): bool
    {
        foreach ($this->items as $item) {
            if ($item->sku->name === $sku->name) {
                return true;
            }
        }

        return false;
    }

    public function increaseQuantityForSkuItem(Sku $sku): ShoppingCart
    {
        foreach ($this->items as $item) {
            if ($item->sku->name === $sku->name) {
                $item->addQuantity();
            }
        }

        return $this;
    }

    public function addDiscount(Discount $discount): ShoppingCart
    {
        $this->discounts[] = $discount;

        return $this;
    }

    public function getTotal(): int
    {
        $this->total = 0;
        foreach ($this->items as $item) {
            $this->total += $item->getTotal();
        }

        foreach ($this->discounts as $discount) {
            $this->total -= $discount->amount;
        }

        return $this->total;
    }
}
