<?php

namespace App\Filament\Resources\B3Logbooks;

use App\Filament\Resources\B3Logbooks\Pages\CreateB3Logbook;
use App\Filament\Resources\B3Logbooks\Pages\EditB3Logbook;
use App\Filament\Resources\B3Logbooks\Pages\ListB3Logbooks;
use App\Filament\Resources\B3Logbooks\Pages\ViewB3Logbook;
use App\Filament\Resources\B3Logbooks\Schemas\B3LogbookForm;
use App\Filament\Resources\B3Logbooks\Schemas\B3LogbookInfolist;
use App\Filament\Resources\B3Logbooks\Tables\B3LogbooksTable;
use App\Models\B3Logbook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class B3LogbookResource extends Resource
{
    protected static ?string $model = B3Logbook::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';

    // protected static ?string $recordTitleAttribute = 'B3Logbook';

    protected static ?string $recordTitleAttribute = 'Logbook Limbah B3';

    protected static ?string $navigationLabel = 'Logbook Limbah B3';

    protected static ?string $modelLabel = 'Logbook Limbah B3';

    protected static ?string $pluralModelLabel = 'Logbook Limbah B3';

    public static function form(Schema $schema): Schema
    {
        return B3LogbookForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return B3LogbookInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return B3LogbooksTable::configure($table);
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
            'index' => ListB3Logbooks::route('/'),
            // 'create' => CreateB3Logbook::route('/create'),
            // 'view' => ViewB3Logbook::route('/{record}'),
            // 'edit' => EditB3Logbook::route('/{record}/edit'),
        ];
    }
}
