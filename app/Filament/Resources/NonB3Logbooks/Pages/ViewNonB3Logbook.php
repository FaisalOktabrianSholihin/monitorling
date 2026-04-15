<?php

namespace App\Filament\Resources\NonB3Logbooks\Pages;

use App\Filament\Resources\NonB3Logbooks\NonB3LogbookResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewNonB3Logbook extends ViewRecord
{
    protected static string $resource = NonB3LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
