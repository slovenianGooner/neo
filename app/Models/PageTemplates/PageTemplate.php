<?php

namespace App\Models\PageTemplates;

interface PageTemplate
{
    public static function getName(): string;

    public static function getKey(): string;

    public static function getTemplatePath(): string;

    public static function getSchema(): array;
}
