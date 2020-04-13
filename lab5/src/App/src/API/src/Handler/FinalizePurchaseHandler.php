<?php

namespace App\API\Handler;

use App\Service\Cart\Infrastructure\Factory\CardGatewayFactory;
use App\Service\Payment\API\PaymentAPI;
use App\Service\Payment\Domain\Transformer\CartGatewayToCartVOTransformer;
use App\Service\Product\Domain\Hydrator\ProductVOHydrator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Session\SessionMiddleware;

class FinalizePurchaseHandler implements RequestHandlerInterface
{
    /** @var CardGatewayFactory */
    private $cartGatewayFactory;

    /** @var CartGatewayToCartVOTransformer */
    private $cartGatewayToCardVOTransformer;

    /** @var PaymentAPI */
    private $paymentAPI;

    /** @var ProductVOHydrator */
    private $productVOHydrator;

    public function __construct(
        CardGatewayFactory $cartGatewayFactory,
        CartGatewayToCartVOTransformer $cartGatewayToCardVOTransformer,
        PaymentAPI $paymentAPI,
        ProductVOHydrator $productVOHydrator
    ) {
        $this->cartGatewayFactory = $cartGatewayFactory;
        $this->cartGatewayToCardVOTransformer = $cartGatewayToCardVOTransformer;
        $this->paymentAPI = $paymentAPI;
        $this->productVOHydrator = $productVOHydrator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        $cartGateway = $this->cartGatewayFactory->create($session);
        $cartVO = $this->cartGatewayToCardVOTransformer->transform($cartGateway);

        if (!count($cartVO->getProducts())) {
            return new JsonResponse([
                'message' => 'Cart is empty',
            ], 400);
        }

        $paymentResponse = $this->paymentAPI->createPayment($cartVO);
        if (!$paymentResponse->isSuccess()) {
            return new JsonResponse([
                'data' => $this->productVOHydrator->extractAll($paymentResponse->getNotPurchasedProducts()),
            ], 422);
        }
        $cartGateway->destroyCart();

        return new JsonResponse([], 201);
    }
}
