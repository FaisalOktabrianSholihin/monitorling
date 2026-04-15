<?php

namespace App\Filament\Resources\B3Inspections\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class B3InspectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('petugas')
                    ->required(),
                TextInput::make('shift')
                    ->required(),
            ]);
    }
}
