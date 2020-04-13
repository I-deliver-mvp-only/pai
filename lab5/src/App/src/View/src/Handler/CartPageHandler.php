<?php

declare(strict_types=1);

namespace App\View\Handler;

use App\Service\Cart\Infrastructure\Factory\CardGatewayFactory;
use App\Service\Product\Domain\Hydrator\ProductVOHydrator;
use App\Service\Product\API\ProductsAPI;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Session\SessionMiddleware;
use Zend\Expressive\Template\TemplateRendererInterface;

class CartPageHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $templateRendered;

    /** @var ProductsAPI */
    private $productsAPI;

    /** @var ProductVOHydrator */
    private $productHydrator;

    /** @var CardGatewayFactory */
    private $cartGatewayFactory;

    public function __construct(
        TemplateRendererInterface $templateRenderer,
        ProductsAPI $productsAPI,
        ProductVOHydrator $productHydrator,
        CardGatewayFactory $cardGatewayFactory
    ) {
        $this->templateRendered = $templateRenderer;
        $this->productsAPI = $productsAPI;
        $this->productHydrator = $productHydrator;
        $this->cartGatewayFactory = $cardGatewayFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        $cartGateway = $this->cartGatewayFactory->create($session);
        $products = $cartGateway->getProducts();

        return new HtmlResponse($this->templateRendered->render('app::cart-page', [
            'products' => $this->productHydrator->extractAll($products),
        ]));
    }
}
