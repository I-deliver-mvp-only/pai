<?php

namespace App\Service\Product\Application\Service;

use App\Service\Product\Domain\ValueObject\ProductVO;
use App\Service\Product\Infrastructure\Repository\ProductsRepository;

class GetProductService
{
    /** @var ProductsRepository */
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function execute(int $productId): ?ProductVO
    {
        return $this->productsRepository->findProduct($productId);
    }
}
