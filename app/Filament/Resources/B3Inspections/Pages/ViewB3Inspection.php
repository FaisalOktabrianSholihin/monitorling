<?php

namespace App\Filament\Resources\B3Inspections\Pages;

use App\Filament\Resources\B3Inspections\B3InspectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewB3Inspection extends ViewRecord
{
    protected static string $resource = B3InspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
