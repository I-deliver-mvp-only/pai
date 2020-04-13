<?php

namespace App\Service\Payment\Domain\ValueObject;

use App\Service\Product\Domain\ValueObject\ProductVO;

class PaymentResponseVO
{
    /** @var ProductVO[] */
    private $notPurchasedProducts;

    /** @var bool */
    private $success;

    public function __construct(array $notPurchasedProducts = [])
    {
        $this->notPurchasedProducts = $notPurchasedProducts;
        $this->success = !count($notPurchasedProducts);
    }

    public function getNotPurchasedProducts(): array
    {
        return $this->notPurchasedProducts;
    }

    public function setNotPurchasedProducts(array $notPurchasedProducts): void
    {
        $this->notPurchasedProducts = $notPurchasedProducts;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }
}
