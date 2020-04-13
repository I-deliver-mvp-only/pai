<?php

namespace App\Service\Payment\Domain\Transformer;

use App\Service\Cart\Infrastructure\Gateway\CartGateway;
use App\Service\Payment\Domain\ValueObject\CartVO;

class CartGatewayToCartVOTransformer
{
    public function transform(CartGateway $cartGateway): CartVO
    {
        $cart = new CartVO();
        $cart->setProducts($cartGateway->getProducts());

        return $cart;
    }
}
