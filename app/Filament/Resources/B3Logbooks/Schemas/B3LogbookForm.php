<?php

namespace App\Filament\Resources\B3Logbooks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Radio;

class B3LogbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            // ->components([
            //     TextInput::make('jenis_limbah')
            //         ->required(),
            //     Select::make('tipe_transaksi')
            //         ->options(['Masuk' => 'Masuk', 'Keluar' => 'Keluar'])
            //         ->required(),
            //     DatePicker::make('tanggal')
            //         ->required(),
            //     TextInput::make('jumlah')
            //         ->required()
            //         ->numeric(),
            //     TextInput::make('sumber_limbah')
            //         ->default(null),
            //     TextInput::make('tujuan_vendor')
            //         ->default(null),
            //     TextInput::make('no_manifest')
            //         ->default(null),
            //     Textarea::make('keterangan')
            //         ->default(null)
            //         ->columnSpanFull(),
            // ]);
            ->components([
                Section::make('Informasi Transaksi')
                    ->schema([
                        Select::make('jenis_limbah')
                            ->label('Jenis Limbah B3')
                            ->options([
                                'Lampu TL' => 'Lampu TL',
                                'Kain Majun Terkontaminasi' => 'Kain Majun Terkontaminasi',
                                'Oli Bekas' => 'Oli Bekas',
                                'Kemasan Bahan Kimia' => 'Kemasan Bahan Kimia',
                                'Aki Bekas' => 'Aki Bekas',
                                'Filter Bekas' => 'Filter Bekas',
                                // 'Sludge IPAL' => 'Sludge IPAL',
                            ])
                            ->native(false)
                            ->required(),

                        Select::make('tipe_transaksi')
                            ->label('Tipe Transaksi')
                            ->options([
                                'Masuk' => 'Masuk',
                                'Keluar' => 'Keluar',
                            ])
                            ->native(false)
                            ->required()
                            ->live(), // Wajib ada agar form bisa bereaksi secara real-time

                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->default(now()),

                        TextInput::make('jumlah')
                            ->label('Jumlah (kg)')
                            ->numeric()
                            ->step('0.01')
                            ->required(),
                    ])->columns(2),

                Section::make('Detail Sumber / Tujuan')
                    ->schema([
                        // Muncul hanya jika transaksi MASUK
                        TextInput::make('sumber_limbah')
                            ->label('Sumber Limbah')
                            ->visible(fn(Get $get) => $get('tipe_transaksi') === 'Masuk'),

                        // Muncul hanya jika transaksi KELUAR
                        TextInput::make('tujuan_vendor')
                            ->label('Tujuan (Vendor)')
                            ->visible(fn(Get $get) => $get('tipe_transaksi') === 'Keluar'),

                        // Muncul hanya jika transaksi KELUAR
                        TextInput::make('no_manifest')
                            ->label('No. Manifest / Festronik')
                            ->visible(fn(Get $get) => $get('tipe_transaksi') === 'Keluar'),

                        Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->default(null)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('D. Checklist Fasilitas TPS B3')
                    ->schema([
                        Radio::make('tps_simbol')
                            ->label('Simbol/Label B3 terpasang dengan benar')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak' => 'Rusak',
                            ])
                            ->inline(), // Membuat pilihan berjejer ke samping

                        Radio::make('tps_palet')
                            ->label('Palet tidak rusak dan bersih')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak' => 'Rusak',
                            ])
                            ->inline(),

                        Radio::make('tps_spillkit')
                            ->label('Spill kit tersedia dan lengkap')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak' => 'Rusak',
                            ])
                            ->inline(),

                        Radio::make('tps_apar')
                            ->label('APAR di TPS tersedia dan valid')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak' => 'Rusak',
                            ])
                            ->inline(),

                        Radio::make('tps_lantai')
                            ->label('Lantai TPS tidak bocor/retak')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak' => 'Rusak',
                            ])
                            ->inline(),

                        Radio::make('tps_ventilasi')
                            ->label('Ventilasi TPS berfungsi baik')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak' => 'Rusak',
                            ])
                            ->inline(),
                    ])->columns(2),
            ]);
    }
}
