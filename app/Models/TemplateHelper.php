<?php

namespace App\Models;

use App\Models\Template;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

class TemplateHelper
{
    public static function getTemplates(string $basePath): Collection
    {
        return collect(File::files(app_path($basePath)))
            ->map(function (SplFileInfo $file) use ($basePath) {
                /**
                 * @var Template $class
                 */
                $class = 'App\\' . str_replace('/', '\\', $basePath) . '\\' . $file->getBasename('.php');
                return [
                    'key' => $class::getKey(),
                    'name' => $class::getName(),
                    'class' => $class,
                ];
            });
    }

    public static function getTemplateOptions(string $basePath): array
    {
        return self::getTemplates($basePath)->mapWithKeys(function (array $class) {
            /**
             * @var Template $class
             */
            return [
                $class['key'] => $class['name'],
            ];
        })->toArray();
    }

    public static function getFromValue(string $basePath, string $value): ?string
    {
        $template = self::getTemplates($basePath)->where('key', $value)->first();

        if (!$template) {
            return null;
        }

        return $template['class'];
    }
}
