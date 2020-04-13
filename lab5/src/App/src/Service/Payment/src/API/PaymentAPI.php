<?php

namespace App\Service\Payment\API;

use App\Service\Payment\Application\Service\CreatePaymentService;
use App\Service\Payment\Domain\ValueObject\CartVO;
use App\Service\Payment\Domain\ValueObject\PaymentResponseVO;

class PaymentAPI
{
    /** @var CreatePaymentService */
    private $createPaymentService;

    public function __construct(CreatePaymentService $createPaymentService)
    {
        $this->createPaymentService = $createPaymentService;
    }

    public function createPayment(CartVO $cart): PaymentResponseVO
    {
        return $this->createPaymentService->execute($cart);
    }
}
