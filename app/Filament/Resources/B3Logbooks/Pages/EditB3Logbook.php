<?php

namespace App\Filament\Resources\B3Logbooks\Pages;

use App\Filament\Resources\B3Logbooks\B3LogbookResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditB3Logbook extends EditRecord
{
    protected static string $resource = B3LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
