<?php

namespace App\Filament\Resources\B3Logbooks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class B3LogbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_limbah')
                    ->required(),
                Select::make('tipe_transaksi')
                    ->options(['Masuk' => 'Masuk', 'Keluar' => 'Keluar'])
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('sumber_limbah')
                    ->default(null),
                TextInput::make('tujuan_vendor')
                    ->default(null),
                TextInput::make('no_manifest')
                    ->default(null),
                Textarea::make('keterangan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
