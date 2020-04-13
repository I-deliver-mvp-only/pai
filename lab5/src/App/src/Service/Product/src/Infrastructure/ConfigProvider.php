<?php

namespace App\Service\Product\Infrastructure;

use App\Service\Product\Application\Service\GetProductService;
use App\Service\Product\Application\Service\GetProductsService;
use App\Service\Product\Domain\Hydrator\ProductVOHydrator;
use App\Service\Product\Infrastructure\Repository\ProductsRepository;
use App\Service\Product\API\ProductsAPI;
use Blast\ReflectionFactory\ReflectionFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    ProductsAPI::class => ReflectionFactory::class,
                    GetProductsService::class => ReflectionFactory::class,
                    GetProductService::class => ReflectionFactory::class,
                    ProductsRepository::class => ReflectionFactory::class,
                    ProductVOHydrator::class => ReflectionFactory::class,
                ],
            ],
        ];
    }
}
