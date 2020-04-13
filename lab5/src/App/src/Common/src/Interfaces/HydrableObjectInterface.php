<?php

namespace App\Common\Interfaces;

interface HydrableObjectInterface
{
    public static function fromArray(array $data);

    public function toArray(): array;
}
