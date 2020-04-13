<?php

namespace App\Service\Product\Infrastructure\Repository;

use App\Service\Product\Domain\ValueObject\ProductVO;
use Doctrine\DBAL\Connection;

class ProductsRepository
{
    /** @var Connection */
    private $dbalConnection;

    public function __construct(Connection $dbalConnection)
    {
        $this->dbalConnection = $dbalConnection;
    }

    public function findProducts(): array
    {
        $query = $this->dbalConnection->query("SELECT id, name, price, img_url AS imgUrl FROM products");

        return array_map(ProductVO::class . '::fromArray', $query->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function findProduct(int $productId): ?ProductVO
    {
        $stmt = $this->dbalConnection->prepare("SELECT id, name, price, img_url AS imgUrl FROM products
            WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $product ? ProductVO::fromArray($product) : null;
    }
}
