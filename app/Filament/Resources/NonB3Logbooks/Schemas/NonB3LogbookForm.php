<?php

namespace App\Filament\Resources\NonB3Logbooks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class NonB3LogbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori')
                    ->options(['Organik' => 'Organik', 'Domestik' => 'Domestik'])
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('jenis_limbah')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('satuan')
                    ->required()
                    ->default('kg'),
                TextInput::make('tujuan')
                    ->default(null),
                TextInput::make('pengangkut')
                    ->default(null),
                TextInput::make('no_dokumen')
                    ->default(null),
                Textarea::make('keterangan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
