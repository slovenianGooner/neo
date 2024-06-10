<?php

namespace App\Filament\Resources\ProductSpecificationTypeResource\Pages;

use App\Filament\Resources\ProductSpecificationTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductSpecificationType extends EditRecord
{
    protected static string $resource = ProductSpecificationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
