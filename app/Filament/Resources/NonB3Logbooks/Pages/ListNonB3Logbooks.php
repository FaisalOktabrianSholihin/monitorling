<?php

namespace App\Filament\Resources\NonB3Logbooks\Pages;

use App\Filament\Resources\NonB3Logbooks\NonB3LogbookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNonB3Logbooks extends ListRecords
{
    protected static string $resource = NonB3LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
