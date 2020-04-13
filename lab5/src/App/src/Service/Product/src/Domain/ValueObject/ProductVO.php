<?php

namespace App\Service\Product\Domain\ValueObject;

use App\Common\Interfaces\HydrableObjectInterface;
use App\Service\Product\Domain\Mapper\ProductVOMapper;
use JsonSerializable;

class ProductVO implements HydrableObjectInterface, JsonSerializable
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var float */
    private $price;

    /** @var string */
    private $imgUrl;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): void
    {
        $this->imgUrl = $imgUrl;
    }

    public static function fromArray(array $data): self
    {
        $product = new self();
        $product->setId($data[ProductVOMapper::ID]);
        $product->setName($data[ProductVOMapper::NAME]);
        $product->setPrice($data[ProductVOMapper::PRICE]);
        $product->setImgUrl($data[ProductVOMapper::IMG_URL]);

        return $product;
    }

    public function toArray(): array
    {
        return [
            ProductVOMapper::ID => $this->getId(),
            ProductVOMapper::NAME => $this->getName(),
            ProductVOMapper::PRICE => $this->getPrice(),
            ProductVOMapper::IMG_URL => $this->getImgUrl(),
        ];
    }

    public function jsonSerialize()
    {
        return json_encode($this->toArray());
    }
}
