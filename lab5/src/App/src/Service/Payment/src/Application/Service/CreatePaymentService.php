<?php

namespace App\Service\Payment\Application\Service;

use App\Service\Payment\Domain\ValueObject\CartVO;
use App\Service\Payment\Domain\ValueObject\PaymentResponseVO;
use App\Service\Payment\Infrastructure\Repository\PaymentRepository;

class CreatePaymentService
{
    /** @var PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function execute(CartVO $cart): PaymentResponseVO
    {
        return $this->paymentRepository->createPayment($cart);
    }
}
