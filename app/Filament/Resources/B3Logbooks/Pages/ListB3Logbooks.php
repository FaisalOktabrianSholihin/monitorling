<?php

namespace App\Filament\Resources\B3Logbooks\Pages;

use App\Filament\Resources\B3Logbooks\B3LogbookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListB3Logbooks extends ListRecords
{
    protected static string $resource = B3LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
