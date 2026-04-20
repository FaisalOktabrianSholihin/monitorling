<?php

namespace App\Filament\Resources\NonB3Logbooks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class NonB3LogbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            // ->components([
            //     Select::make('kategori')
            //         ->options(['Organik' => 'Organik', 'Domestik' => 'Domestik'])
            //         ->required(),
            //     DatePicker::make('tanggal')
            //         ->required(),
            //     TextInput::make('jenis_limbah')
            //         ->required(),
            //     TextInput::make('jumlah')
            //         ->required()
            //         ->numeric(),
            //     TextInput::make('satuan')
            //         ->required()
            //         ->default('kg'),
            //     TextInput::make('tujuan')
            //         ->default(null),
            //     TextInput::make('pengangkut')
            //         ->default(null),
            //     TextInput::make('no_dokumen')
            //         ->default(null),
            //     Textarea::make('keterangan')
            //         ->default(null)
            //         ->columnSpanFull(),
            // ]);
            ->components([
                Section::make('Informasi Limbah Non-B3')
                    ->schema([
                        Select::make('kategori')
                            ->label('Kategori Limbah')
                            ->options([
                                'Organik' => 'Organik (Sisa Produksi)',
                                'Domestik' => 'Domestik (Sampah Kantor/Rumah Tangga)',
                            ])
                            ->native(false)
                            ->required()
                            ->live() // Aktifkan live update
                            ->afterStateUpdated(function (Set $set, $state) {
                                // Otomatis ubah satuan saat kategori dipilih
                                if ($state === 'Organik') {
                                    $set('satuan', 'kg');
                                } elseif ($state === 'Domestik') {
                                    $set('satuan', 'm³');
                                } else {
                                    $set('satuan', null);
                                }
                            }),

                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->default(now()),

                        TextInput::make('jenis_limbah')
                            ->label('Jenis Limbah / Sampah')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('jumlah')
                            ->label(fn(Get $get) => $get('kategori') === 'Domestik' ? 'Volume' : 'Berat')
                            ->numeric()
                            ->step('0.01')
                            ->required(),

                        TextInput::make('satuan')
                            ->label('Satuan')
                            ->readOnly()
                            ->extraInputAttributes(['style' => 'font-weight: bold;']),
                    ])->columns(2),

                Section::make('Tujuan & Dokumen')
                    ->schema([
                        TextInput::make('tujuan')
                            ->label('Tujuan Pemanfaatan')
                            ->visible(fn(Get $get) => $get('kategori') === 'Organik'),

                        TextInput::make('pengangkut')
                            ->label('Pihak Pengangkut')
                            ->visible(fn(Get $get) => $get('kategori') === 'Domestik'),

                        TextInput::make('no_dokumen')
                            ->label('No. Dokumen')
                            ->default(null),

                        Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->default(null)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
