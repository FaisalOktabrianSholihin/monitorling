<?php

namespace App\Filament\Resources\NonB3Logbooks;

use App\Filament\Resources\NonB3Logbooks\Pages\CreateNonB3Logbook;
use App\Filament\Resources\NonB3Logbooks\Pages\EditNonB3Logbook;
use App\Filament\Resources\NonB3Logbooks\Pages\ListNonB3Logbooks;
use App\Filament\Resources\NonB3Logbooks\Pages\ViewNonB3Logbook;
use App\Filament\Resources\NonB3Logbooks\Schemas\NonB3LogbookForm;
use App\Filament\Resources\NonB3Logbooks\Schemas\NonB3LogbookInfolist;
use App\Filament\Resources\NonB3Logbooks\Tables\NonB3LogbooksTable;
use App\Models\NonB3Logbook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NonB3LogbookResource extends Resource
{
    protected static ?string $model = NonB3Logbook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'NonB3Logbook';

    public static function form(Schema $schema): Schema
    {
        return NonB3LogbookForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return NonB3LogbookInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NonB3LogbooksTable::configure($table);
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
            'index' => ListNonB3Logbooks::route('/'),
            'create' => CreateNonB3Logbook::route('/create'),
            'view' => ViewNonB3Logbook::route('/{record}'),
            'edit' => EditNonB3Logbook::route('/{record}/edit'),
        ];
    }
}
