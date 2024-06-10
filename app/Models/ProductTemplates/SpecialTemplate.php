<?php

namespace App\Models\ProductTemplates;

use App\Models\Template;

class SpecialTemplate implements Template
{
    public static function getName(): string
    {
        return "Special";
    }

    public static function getKey(): string
    {
        return "special";
    }

    public static function getSchema(): array
    {
        return [
            // Add your schema here
        ];
    }

    public static function getTemplatePath(): string
    {
        return 'product-templates.special';
    }
}
