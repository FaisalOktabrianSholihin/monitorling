<?php

namespace App\Filament\Resources\B3Inspections\Pages;

use App\Filament\Resources\B3Inspections\B3InspectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListB3Inspections extends ListRecords
{
    protected static string $resource = B3InspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
