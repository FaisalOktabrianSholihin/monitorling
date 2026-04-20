<?php

namespace App\Filament\Resources\IpalMonitorings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class IpalMonitoringForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
                    ->readOnly()
                    ->default(now())
                    ->columnSpanFull(),

                Section::make('Parameter Kualitas Air')
                    ->schema([
                        TextInput::make('ph_inlet')
                            ->label('pH Inlet')
                            ->numeric()
                            ->step('0.01')
                            ->default(null),

                        TextInput::make('ph_outlet')
                            ->label('pH Outlet')
                            ->numeric()
                            ->step('0.01')
                            ->default(null)
                            ->live(onBlur: true) // Aktif saat pindah kolom
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $ph = (float) $get('ph_outlet');
                                if ($ph > 0) {
                                    if ($ph < 6) {
                                        $set('status_ph', 'Rendah');
                                    } elseif ($ph > 9) {
                                        $set('status_ph', 'Tinggi');
                                    } else {
                                        $set('status_ph', 'Normal');
                                    }
                                } else {
                                    $set('status_ph', null);
                                }
                            }),

                        TextInput::make('status_ph')
                            ->label('Status pH')
                            ->default(null)
                            ->readOnly()
                            ->extraInputAttributes([]),

                        TextInput::make('suhu')
                            ->label('Suhu (°C)')
                            ->numeric()
                            ->step('0.01')
                            ->default(null),
                    ])->columns(4),

                Section::make('Debit Air (m³)')
                    ->schema([
                        TextInput::make('debit_pagi')
                            ->label('Debit Pagi')
                            ->numeric()
                            ->default(null)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Get $get, Set $set) => $set('total_debit', (float) $get('debit_pagi') + (float) $get('debit_sore'))),

                        TextInput::make('debit_sore')
                            ->label('Debit Sore')
                            ->numeric()
                            ->default(null)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Get $get, Set $set) => $set('total_debit', (float) $get('debit_pagi') + (float) $get('debit_sore'))),

                        TextInput::make('total_debit')
                            ->label('Total Debit')
                            ->numeric()
                            ->default(null)
                            ->readOnly()
                            ->extraInputAttributes([]),
                    ])->columns(3),

                Section::make('Fisik, Kimia & Catatan')
                    ->schema([
                        Select::make('warna') // Diubah ke Select
                            ->label('Warna')
                            ->options([
                                'Jernih' => 'Jernih',
                                'Keruh' => 'Keruh',
                                'Hitam' => 'Hitam',
                                'Kuning' => 'Kuning',
                                'Hijau' => 'Hijau',
                            ])
                            ->native(false) // Membuat tampilan dropdown lebih modern
                            ->default(null),

                        Select::make('bau') // Diubah ke Select
                            ->label('Bau')
                            ->options([
                                'Tidak Berbau' => 'Tidak Berbau',
                                'Berbau' => 'Berbau',
                                // 'Busuk' => 'Busuk',
                            ])
                            ->native(false)
                            ->default(null),

                        TextInput::make('bahan_kimia')
                            ->label('Bahan Kimia (kg)')
                            ->numeric()
                            ->step('0.01')
                            ->default(null),

                        Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->default(null)
                            ->columnSpanFull(),
                    ])->columns(3),
            ]);
    }
}
