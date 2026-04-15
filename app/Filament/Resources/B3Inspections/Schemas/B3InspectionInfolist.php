<?php

namespace App\Filament\Resources\B3Inspections\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class B3InspectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('petugas'),
                TextEntry::make('shift'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
