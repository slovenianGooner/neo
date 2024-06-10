<?php

namespace App\Filament\Resources\ProductSpecificationTypeResource\Pages;

use App\Filament\Resources\ProductSpecificationTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductSpecificationType extends CreateRecord
{
    protected static string $resource = ProductSpecificationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
