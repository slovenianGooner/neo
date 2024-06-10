<?php

namespace App\Filament\Resources\ProductSpecificationTypeResource\Pages;

use App\Filament\Resources\ProductSpecificationTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductSpecificationTypes extends ListRecords
{
    protected static string $resource = ProductSpecificationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
