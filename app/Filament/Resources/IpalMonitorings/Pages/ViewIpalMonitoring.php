<?php

namespace App\Filament\Resources\IpalMonitorings\Pages;

use App\Filament\Resources\IpalMonitorings\IpalMonitoringResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIpalMonitoring extends ViewRecord
{
    protected static string $resource = IpalMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
