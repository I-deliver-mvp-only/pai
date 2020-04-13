<?php

namespace App\Service\Cart\Infrastructure\Factory;

use App\Service\Cart\Infrastructure\Gateway\CartGateway;
use Zend\Expressive\Session\LazySession;

class CardGatewayFactory
{
    public function create(LazySession $session): CartGateway
    {
        return new CartGateway($session);
    }
}
