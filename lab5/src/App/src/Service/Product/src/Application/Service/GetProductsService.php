<?php

namespace App\Service\Product\Application\Service;

use App\Service\Product\Infrastructure\Repository\ProductsRepository;

class GetProductsService
{
    /** @var ProductsRepository */
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function execute(): array
    {
        return $this->productsRepository->findProducts();
    }
}
