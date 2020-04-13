<?php

namespace App\Service\Payment\Infrastructure\Repository;

use App\Service\Payment\Domain\Exception\ProductsNoLongerAvailableException;
use App\Service\Payment\Domain\ValueObject\CartVO;
use App\Service\Payment\Domain\ValueObject\PaymentResponseVO;
use App\Service\Product\Domain\ValueObject\ProductVO;
use Doctrine\DBAL\Connection;

class PaymentRepository
{
    /** @var Connection */
    private $dbalConnection;

    public function __construct(Connection $dbalConnection)
    {
        $this->dbalConnection = $dbalConnection;
    }

    public function createPayment(CartVO $cart): PaymentResponseVO
    {
        try {
            $this->dbalConnection->transactional(function () use ($cart) {
                $notDeletedProducts = [];
                foreach ($cart->getProducts() as $product) {
                    /** @var ProductVO $product */
                    $stmt = $this->dbalConnection->prepare("DELETE FROM products WHERE id = ?");
                    $stmt->execute([$product->getId()]);
                    if (!$stmt->rowCount()) {
                        $notDeletedProducts[] = $product;
                    }
                }

                if (count($notDeletedProducts)) {
                    throw new ProductsNoLongerAvailableException($notDeletedProducts);
                }
            });
        } catch (ProductsNoLongerAvailableException $e) {
            return new PaymentResponseVO($e->getProductsNotAvailable());
        }

        return new PaymentResponseVO();
    }
}
