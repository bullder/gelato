<?php declare(strict_types=1);

namespace App\Domain;

class ShoppingCart
{
    public const SLUG_TEMPLATE = '/cart?skus=%s';

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

    public function getItemBySku(string $sku): ?Item
    {
        foreach ($this->items as $item) {
            if ($item->sku->name === $sku) {
                return $item;
            }
        }

        return null;
    }

    public function hasSkuItem(Sku $sku): bool
    {
        return null !== $this->getItemBySku($sku->name);
    }

    public function increaseQuantityForSkuItem(Sku $sku): ShoppingCart
    {
        $item = $this->getItemBySku($sku->name);
        if ($item) {
            $item->addQuantity();
        }

        return $this;
    }

    public function addDiscount(Discount $discount): ShoppingCart
    {
        $this->discounts[] = $discount;

        return $this;
    }

    public function updateTotal(): void
    {
        $this->total = 0;
        foreach ($this->items as $item) {
            $this->total += $item->getTotal();
        }

        foreach ($this->discounts as $discount) {
            $this->total -= $discount->amount;
        }
    }

    public function getTotal(): int
    {
        $this->updateTotal();

        return $this->total;
    }

    public function getUrlForSku(Sku $sku): string
    {
        $slugParts = [$sku->name];
        foreach ($this->items as $item) {
            $slugParts = array_merge(
                $slugParts,
                array_fill(0, $item->quantity, $item->sku->name)
            );
        }

        return sprintf(self::SLUG_TEMPLATE, implode(',', $slugParts));
    }
}
