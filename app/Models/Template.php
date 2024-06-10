<?php

namespace App\Models;

interface Template
{
    public static function getName(): string;

    public static function getKey(): string;

    public static function getTemplatePath(): string;

    public static function getSchema(): array;
}
