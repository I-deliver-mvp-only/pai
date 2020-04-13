<?php

namespace App\API;

use App\API\Handler\AddProductToCartHandler;
use App\API\Handler\FinalizePurchaseHandler;
use App\API\Handler\RemoveProductFromCart;
use Blast\ReflectionFactory\ReflectionFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    AddProductToCartHandler::class => ReflectionFactory::class,
                    FinalizePurchaseHandler::class => ReflectionFactory::class,
                    RemoveProductFromCart::class => ReflectionFactory::class,
                ],
            ],
            'routes' => [
                [
                    'name' => 'add-product-to-cart',
                    'path' => '/api/cart/product/{productId:\d+}',
                    'middleware' => AddProductToCartHandler::class,
                    'allowed_methods' => ['POST'],
                ],
                [
                    'name' => 'remove-product-from-cart',
                    'path' => '/api/cart/product/{productId:\d+}',
                    'middleware' => RemoveProductFromCart::class,
                    'allowed_methods' => ['DELETE'],
                ],
                [
                    'name' => 'finalize-purchase',
                    'path' => '/api/payment',
                    'middleware' => FinalizePurchaseHandler::class,
                    'allowed_methods' => ['POST'],
                ],
            ],
        ];
    }
}
