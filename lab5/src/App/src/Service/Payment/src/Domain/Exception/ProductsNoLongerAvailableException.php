<?php

namespace App\Service\Payment\Domain\Exception;

use App\Service\Product\Domain\ValueObject\ProductVO;
use RuntimeException;

class ProductsNoLongerAvailableException extends RuntimeException
{
    /** @var ProductVO[] */
    private $productsNotAvailable;

    /** @param ProductVO[] $products */
    public function __construct(array $products)
    {
        $this->productsNotAvailable = $products;

        $productsIds = array_map(function(ProductVO $product) {
            return $product->getId();
        }, $products);
        $concatIds = implode(', ', $productsIds);

        parent::__construct("Products with following Ids ${concatIds}
            are no longer available to purchase");
    }

    public function getProductsNotAvailable(): array
    {
        return $this->productsNotAvailable;
    }
}
