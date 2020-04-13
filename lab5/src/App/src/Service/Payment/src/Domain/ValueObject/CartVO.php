<?php

namespace App\Service\Payment\Domain\ValueObject;

use App\Service\Product\Domain\ValueObject\ProductVO;

class CartVO
{
    /** @var ProductVO[] */
    private $products;

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }
}
