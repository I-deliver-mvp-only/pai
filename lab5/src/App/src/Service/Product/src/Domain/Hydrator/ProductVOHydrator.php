<?php

namespace App\Service\Product\Domain\Hydrator;

use App\Service\Product\Domain\ValueObject\ProductVO;

class ProductVOHydrator
{
    public function extractAll(array $products): array
    {
        return array_map(function(ProductVO $product) {
            return $product->toArray();
        }, $products);
    }
}
