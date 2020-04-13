<?php

namespace App\API\Handler;

use App\Service\Cart\Infrastructure\Factory\CardGatewayFactory;
use App\Service\Product\API\ProductsAPI;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Session\SessionMiddleware;

class RemoveProductFromCart implements RequestHandlerInterface
{
    public const PRODUCT_ID = 'productId';

    /** @var CardGatewayFactory */
    private $cartGatewayFactory;

    /** @var ProductsAPI */
    private $productsAPI;

    public function __construct(CardGatewayFactory $cartGatewayFactory, ProductsAPI $productsAPI)
    {
        $this->cartGatewayFactory = $cartGatewayFactory;
        $this->productsAPI = $productsAPI;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        $cartGateway = $this->cartGatewayFactory->create($session);
        $productId = (int)$request->getAttribute(self::PRODUCT_ID);
        $cartGateway->removeProductById($productId);

        return new JsonResponse([]);
    }
}
