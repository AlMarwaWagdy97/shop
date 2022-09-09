<?php

namespace App\Enums;



class BaseStatusEnum extends BaseEnum
{
    public const PUBLISHED = 'published';
    public const UNPUBLISHED = 'unpublished';

    public static function supportedBaseStatus(): array
    {
        return [
            self::PUBLISHED,
            self::UNPUBLISHED,
        ];
    }
}
