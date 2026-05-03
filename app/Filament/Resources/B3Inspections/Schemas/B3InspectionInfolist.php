<?php

namespace App\Filament\Resources\B3Inspections\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class B3InspectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1) // 1. KUNCI UTAMA: Paksa menjadi atas-bawah, bukan kiri-kanan
            ->components([

                // --- BAGIAN ATAS ---
                Section::make('Informasi Inspeksi')
                    ->schema([
                        Grid::make(4) // Buat 4 kolom menyamping agar rapi
                            ->schema([
                                TextEntry::make('tanggal')->date(),
                                TextEntry::make('petugas'),
                                TextEntry::make('shift'),
                                TextEntry::make('created_at')->dateTime(),
                            ]),
                    ]),

                // --- BAGIAN BAWAH ---
                Section::make('Detail Checklist Cemaran')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('Daftar Temuan')
                            ->schema([
                                // Baris 1: Informasi Temuan
                                Grid::make(3)
                                    ->schema([
                                        TextEntry::make('area_zona')
                                            ->label('Area/Zona')
                                            ->weight('bold'),
                                        TextEntry::make('parameter')
                                            ->label('Parameter Pemeriksaan'),
                                        TextEntry::make('status')
                                            ->badge()
                                            ->color(fn(string $state): string => match (strtolower($state)) {
                                                'bersih', 'aman' => 'success',
                                                'temuan', 'kotor' => 'danger',
                                                default => 'warning',
                                            }),
                                    ]),

                                // 2. GARIS PEMBATAS
                                // TextEntry::make('')
                                //     ->default(new HtmlString('<hr class="my-2 border-gray-600">'))
                                //     ->columnSpanFull()
                                //     ->hiddenLabel(),

                                TextEntry::make('divider') // <-- Berikan nama unik di sini
                                    ->default(new HtmlString('<hr class="my-2 border-gray-600">'))
                                    ->columnSpanFull()
                                    ->hiddenLabel(),

                                // Baris 2: Foto Temuan
                                ImageEntry::make('foto_temuan')
                                    ->label('Foto Temuan')
                                    ->columnSpanFull()
                                    ->height(200) // 3. Batasi tinggi gambar agar tidak merusak layout
                                    ->hidden(fn($state) => $state === null),

                                // Baris 3: Detail Tindakan
                                Grid::make(3)
                                    ->schema([
                                        TextEntry::make('tindakan_segera')
                                            ->label('Tindakan Segera'),
                                        TextEntry::make('rekomendasi')
                                            ->label('Rekomendasi Tindakan'),
                                        TextEntry::make('pic')
                                            ->label('PIC'),
                                    ]),
                            ])
                            ->columns(1) // Pastikan isi repeater mengambil full 1 baris
                    ]),
            ]);
    }
}
