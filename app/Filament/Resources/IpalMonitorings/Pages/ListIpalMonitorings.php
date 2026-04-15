<?php

namespace App\Filament\Resources\IpalMonitorings\Pages;

use App\Filament\Resources\IpalMonitorings\IpalMonitoringResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIpalMonitorings extends ListRecords
{
    protected static string $resource = IpalMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
