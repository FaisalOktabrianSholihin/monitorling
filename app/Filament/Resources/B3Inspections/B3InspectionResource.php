<?php

namespace App\Filament\Resources\B3Inspections;

use App\Filament\Resources\B3Inspections\Pages\CreateB3Inspection;
use App\Filament\Resources\B3Inspections\Pages\EditB3Inspection;
use App\Filament\Resources\B3Inspections\Pages\ListB3Inspections;
use App\Filament\Resources\B3Inspections\Pages\ViewB3Inspection;
use App\Filament\Resources\B3Inspections\Schemas\B3InspectionForm;
use App\Filament\Resources\B3Inspections\Schemas\B3InspectionInfolist;
use App\Filament\Resources\B3Inspections\Tables\B3InspectionsTable;
use App\Models\B3Inspection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class B3InspectionResource extends Resource
{
    protected static ?string $model = B3Inspection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'B3Inspection';

    public static function form(Schema $schema): Schema
    {
        return B3InspectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return B3InspectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return B3InspectionsTable::configure($table);
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
            'index' => ListB3Inspections::route('/'),
            // 'create' => CreateB3Inspection::route('/create'),
            // 'view' => ViewB3Inspection::route('/{record}'),
            // 'edit' => EditB3Inspection::route('/{record}/edit'),
        ];
    }
}
