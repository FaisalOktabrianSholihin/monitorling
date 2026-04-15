<?php

namespace App\Filament\Resources\IpalMonitorings;

use App\Filament\Resources\IpalMonitorings\Pages\CreateIpalMonitoring;
use App\Filament\Resources\IpalMonitorings\Pages\EditIpalMonitoring;
use App\Filament\Resources\IpalMonitorings\Pages\ListIpalMonitorings;
use App\Filament\Resources\IpalMonitorings\Pages\ViewIpalMonitoring;
use App\Filament\Resources\IpalMonitorings\Schemas\IpalMonitoringForm;
use App\Filament\Resources\IpalMonitorings\Schemas\IpalMonitoringInfolist;
use App\Filament\Resources\IpalMonitorings\Tables\IpalMonitoringsTable;
use App\Models\IpalMonitoring;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IpalMonitoringResource extends Resource
{
    protected static ?string $model = IpalMonitoring::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    // protected static ?string $recordTitleAttribute = 'IpalMonitoring';

    protected static ?string $recordTitleAttribute = 'Monitoring IPAL';

    protected static ?string $navigationLabel = 'Monitoring IPAL';

    protected static ?string $modelLabel = 'Monitoring IPAL';

    protected static ?string $pluralModelLabel = 'Monitoring IPAL';

    public static function form(Schema $schema): Schema
    {
        return IpalMonitoringForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IpalMonitoringInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IpalMonitoringsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIpalMonitorings::route('/'),
            // 'create' => CreateIpalMonitoring::route('/create'),
            // 'view' => ViewIpalMonitoring::route('/{record}'),
            // 'edit' => EditIpalMonitoring::route('/{record}/edit'),
        ];
    }
}
