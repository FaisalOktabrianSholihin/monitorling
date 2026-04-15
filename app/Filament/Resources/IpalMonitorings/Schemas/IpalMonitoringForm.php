<?php

namespace App\Filament\Resources\IpalMonitorings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class IpalMonitoringForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('ph_inlet')
                    ->numeric()
                    ->default(null),
                TextInput::make('ph_outlet')
                    ->numeric()
                    ->default(null),
                TextInput::make('status_ph')
                    ->default(null),
                TextInput::make('suhu')
                    ->numeric()
                    ->default(null),
                TextInput::make('debit_pagi')
                    ->numeric()
                    ->default(null),
                TextInput::make('debit_sore')
                    ->numeric()
                    ->default(null),
                TextInput::make('total_debit')
                    ->numeric()
                    ->default(null),
                TextInput::make('warna')
                    ->default(null),
                TextInput::make('bau')
                    ->default(null),
                TextInput::make('bahan_kimia')
                    ->numeric()
                    ->default(null),
                Textarea::make('keterangan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
