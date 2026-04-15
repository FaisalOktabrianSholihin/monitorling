<?php

namespace App\Filament\Resources\NonB3Logbooks\Pages;

use App\Filament\Resources\NonB3Logbooks\NonB3LogbookResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditNonB3Logbook extends EditRecord
{
    protected static string $resource = NonB3LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
