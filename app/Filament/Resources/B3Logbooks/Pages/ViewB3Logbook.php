<?php

namespace App\Filament\Resources\B3Logbooks\Pages;

use App\Filament\Resources\B3Logbooks\B3LogbookResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewB3Logbook extends ViewRecord
{
    protected static string $resource = B3LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
