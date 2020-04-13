<?php

namespace App\Service\Product\API;

use App\Service\Product\Application\Service\GetProductService;
use App\Service\Product\Application\Service\GetProductsService;
use App\Service\Product\Domain\ValueObject\ProductVO;

class ProductsAPI
{
    /** @var GetProductsService */
    private $getProductsService;

    /** @var GetProductService */
    private $getProductService;

    public function __construct(
        GetProductsService $getProductsService,
        GetProductService $getProductService
    ) {
        $this->getProductsService = $getProductsService;
        $this->getProductService = $getProductService;
    }

    function getProducts(): array
    {
        return $this->getProductsService->execute();
    }

    public function getProduct(int $productId): ?ProductVO
    {
        return $this->getProductService->execute($productId);
    }
}
