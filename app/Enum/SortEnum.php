<?php

namespace App\Enum;

enum SortEnum: string
{
    CASE UM = 'username-more';
    CASE UL = 'username-less';
    CASE EM = 'email-more';
    CASE EL = 'email-less';
    CASE DM = 'created_at-more';
    CASE DL = 'created_at-less';

    public static function getEnums() : array
    {
        return [
            self::UM->value,
            self::UL->value,
            self::EM->value,
            self::EL->value,
            self::DM->value,
            self::DL->value,
        ];
    }
}
