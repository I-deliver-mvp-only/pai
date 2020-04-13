<?php

namespace App\Service\Payment\Infrastructure;

use App\Service\Payment\API\PaymentAPI;
use App\Service\Payment\Application\Service\CreatePaymentService;
use App\Service\Payment\Domain\Transformer\CartGatewayToCartVOTransformer;
use App\Service\Payment\Infrastructure\Repository\PaymentRepository;
use Blast\ReflectionFactory\ReflectionFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'invokables' => [
                    CartGatewayToCartVOTransformer::class,
                ],
                'factories' => [
                    PaymentAPI::class => ReflectionFactory::class,
                    CreatePaymentService::class => ReflectionFactory::class,
                    PaymentRepository::class => ReflectionFactory::class,
                ],
            ],
        ];
    }
}
