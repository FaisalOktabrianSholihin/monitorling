<?php

namespace App\Filament\Resources\IpalMonitorings\Pages;

use App\Filament\Resources\IpalMonitorings\IpalMonitoringResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIpalMonitoring extends EditRecord
{
    protected static string $resource = IpalMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
