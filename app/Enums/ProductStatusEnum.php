<?php

namespace App\Enums;


class ProductStatusEnum extends BaseEnum
{
    public const IN_STOCK = 'In stock';
    public const OUT_OF_STOCK = 'Out of stock';

    public static function supportedProductStatus(): array
    {
        return [
            self::IN_STOCK,
            self::OUT_OF_STOCK,
        ];
    }

    public static function StatusName($value) :string
    {
        switch ($value) {
            case 1:
                return self::IN_STOCK;
//            case 2:
//                return self::OUT_OF_STOCK;
            default:
                return self::OUT_OF_STOCK;

        }

    }
}
