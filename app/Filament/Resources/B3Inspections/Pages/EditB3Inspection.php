<?php

namespace App\Filament\Resources\B3Inspections\Pages;

use App\Filament\Resources\B3Inspections\B3InspectionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditB3Inspection extends EditRecord
{
    protected static string $resource = B3InspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
