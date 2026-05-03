<?php

namespace App\Filament\Resources\B3Inspections\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class B3InspectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Inspeksi')
                    ->schema([
                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->default(now()),

                        TextInput::make('petugas')
                            ->label('Petugas')
                            ->default(fn() => auth()->user()?->name) // Tarik nama user yang sedang login
                            ->readOnly() // Tambahkan ini agar namanya dikunci dan tidak bisa diganti manual
                            ->extraInputAttributes([]) // Efek warna abu-abu (opsional)
                            ->required()
                            ->maxLength(255),

                        // Select::make('shift')
                        //     ->label('Shift')
                        //     ->options([
                        //         'Pagi' => 'Pagi',
                        //         'Siang' => 'Siang',
                        //         // 'Malam' => 'Malam',
                        //     ])
                        //     ->native(false)
                        //     ->required(),
                        Select::make('shift')
                            ->label('Shift')
                            ->options([
                                'Pagi' => 'Pagi',
                                'Siang' => 'Siang',
                                // 'Malam' => 'Malam',
                            ])
                            ->native(false)
                            ->required()
                            ->default(function () {
                                // Ambil jam saat ini dengan zona waktu WIB
                                $jam = now()->timezone('Asia/Jakarta')->format('H');

                                // Logika penentuan shift berdasarkan jam (format 24 jam)
                                if ($jam >= 6 && $jam < 12) {
                                    return 'Pagi';  // Jam 06:00 s/d 13:59
                                } elseif ($jam >= 12 && $jam < 18) {
                                    return 'Siang'; // Jam 14:00 s/d 21:59
                                } else {
                                    return 'Malam'; // Jam 22:00 s/d 05:59
                                }
                            }),
                    ])->columns(2)
                    ->columnSpanFull(),

                Section::make('Detail Checklist Cemaran')
                    ->schema([
                        // Inilah komponen Repeater untuk tabel child
                        Repeater::make('items')
                            ->relationship('items') // HARUS sama dengan nama fungsi relasi di Model B3Inspection
                            ->label('Daftar Temuan')
                            ->schema([
                                Select::make('area_zona')
                                    ->label('Area/Zona')
                                    ->options([
                                        'Area Produksi' => 'Area Produksi',
                                        'Area Penyimpanan Bahan Kimia' => 'Area Penyimpanan Bahan Kimia',
                                        'TPS B3' => 'TPS B3',
                                        'Area IPAL' => 'Area IPAL',
                                    ])
                                    ->native(false)
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('parameter')
                                    ->label('Parameter Pemeriksaan')
                                    ->required()
                                    ->columnSpan(2),

                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'Bersih' => 'Bersih',
                                        'Tercemar' => 'Tercemar',
                                    ])
                                    ->native(false)
                                    ->required()
                                    ->columnSpan(1),

                                FileUpload::make('foto_temuan')
                                    ->label('Foto Temuan')
                                    ->image() // Hanya menerima file gambar
                                    ->directory('foto-cemaran-b3') // Folder penyimpanan di storage
                                    ->imageEditor() // Mengaktifkan fitur crop/edit bawaan Filament
                                    ->columnSpanFull()
                                    ->required(),

                                Textarea::make('tindakan_segera')
                                    ->label('Tindakan Segera')
                                    ->default(null),

                                Textarea::make('rekomendasi')
                                    ->label('Rekomendasi Tindakan')
                                    ->default(null),

                                TextInput::make('pic')
                                    ->label('PIC')
                                    ->maxLength(255)
                                    ->default(null),
                            ])
                            ->columns(4) // Membagi item repeater menjadi 4 kolom sejajar
                            ->defaultItems(1) // Otomatis memunculkan 1 baris kosong saat form dibuka
                            ->addActionLabel('Tambah Temuan Baru') // Teks tombol tambah
                            ->collapsible() // Bisa di-minimize/expand
                            ->itemLabel(fn(array $state): ?string => $state['area_zona'] ?? null), // Label di header repeater
                    ])->columnSpanFull(),
            ]);
    }
}
