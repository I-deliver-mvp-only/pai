<?php

namespace App\Service\Cart\Infrastructure\Gateway;

use App\Service\Product\Domain\ValueObject\ProductVO;
use Zend\Expressive\Session\LazySession;

class CartGateway
{
    public const CART_PRODUCTS = 'cartProducts';

    /** @var LazySession */
    private $session;

    public function __construct(LazySession $session)
    {
        $this->session = $session;
    }

    public function addProduct(ProductVO $product)
    {
        $this->session->set(self::CART_PRODUCTS, array_merge(
            $this->session->get(self::CART_PRODUCTS) ?? [],
            [json_encode($product)]
        ));
    }

    public function removeProductById(int $productId)
    {
        $products = $this->getProducts();
        for ($i = 0 ; $i < count($products) ; $i++) {
            if ($products[$i]->getId() === $productId) {
                $serializedProducts = $this->session->get(self::CART_PRODUCTS);
                array_splice($serializedProducts, $i, 1);
                $this->session->set(self::CART_PRODUCTS, $serializedProducts);
                break;
            }
        }
    }

    public function getProductsCount(): int
    {
        return count($this->session->get(self::CART_PRODUCTS) ?? []);
    }

    public function getProducts(): array
    {
        return array_map(function(string $jsonItem) {
            return ProductVO::fromArray(json_decode(json_decode($jsonItem, true), true));
        }, $this->session->get(self::CART_PRODUCTS) ?? []);
    }

    public function getProductById(int $productId): ?ProductVO
    {
        $products = $this->getProducts();
        for ($i = 0 ; $i < count($products) ; $i++) {
            if ($products[$i]->getId() === $productId) {
                return $products[$i];
            }
        }

        return null;
    }

    public function destroyCart()
    {
        $this->session->set(self::CART_PRODUCTS, null);
    }
}
