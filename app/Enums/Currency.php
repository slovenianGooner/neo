<?php

namespace App\Enums;

enum Currency: string
{
    case EUR = 'EUR';
    case USD = 'USD';
    case GBP = 'GBP';

    public static function getOptions(): array
    {
        return [
            'EUR' => 'Euro',
            'USD' => 'US Dollar',
            'GBP' => 'British Pound',
        ];
    }
}
