<?php

namespace App\Models\PageTemplates;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

class PageTemplateHelper
{
    public static function getTemplates(): Collection
    {
        return collect(File::files(app_path('Models/PageTemplates')))
            ->filter(function (SplFileInfo $file) {
                return !Str::startsWith($file->getBasename('.php'), 'PageTemplate');
            })->map(function (SplFileInfo $file) {
                /**
                 * @var PageTemplate $class
                 */
                $class = 'App\\Models\\PageTemplates\\' . $file->getBasename('.php');
                return [
                    'key' => $class::getKey(),
                    'name' => $class::getName(),
                    'class' => $class,
                ];
            });
    }

    public static function getTemplateOptions(): array
    {
        return self::getTemplates()->mapWithKeys(function (array $class) {
            /**
             * @var PageTemplate $class
             */
            return [
                $class['key'] => $class['name'],
            ];
        })->toArray();
    }

    public static function getFromValue($value): ?string
    {
        $template = self::getTemplates()->where('key', $value)->first();

        if (!$template) {
            return null;
        }

        return $template['class'];
    }
}
