<?php

namespace App\Filament\Resources\NonB3Logbooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\Summarizers\Sum;

class NonB3LogbooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // ->columns([
            //     TextColumn::make('kategori'),
            //     TextColumn::make('tanggal')
            //         ->date()
            //         ->sortable(),
            //     TextColumn::make('jenis_limbah')
            //         ->searchable(),
            //     TextColumn::make('jumlah')
            //         ->numeric()
            //         ->sortable(),
            //     TextColumn::make('satuan')
            //         ->searchable(),
            //     TextColumn::make('tujuan')
            //         ->searchable(),
            //     TextColumn::make('pengangkut')
            //         ->searchable(),
            //     TextColumn::make('no_dokumen')
            //         ->searchable(),
            //     TextColumn::make('created_at')
            //         ->dateTime()
            //         ->sortable()
            //         ->toggleable(isToggledHiddenByDefault: true),
            //     TextColumn::make('updated_at')
            //         ->dateTime()
            //         ->sortable()
            //         ->toggleable(isToggledHiddenByDefault: true),
            // ])
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Organik' => 'success',
                        'Domestik' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('jenis_limbah')
                    ->label('Jenis Limbah')
                    ->sortable()
                    ->searchable(),

                // Menampilkan Jumlah + Satuan (Misal: "10.00 kg" atau "50.00 m³")
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->numeric(2)
                    ->suffix(fn($record) => ' ' . $record->satuan)
                    ->summarize(Sum::make()->label('Total')), // Menjumlahkan otomatis di bawah tabel

                TextColumn::make('tujuan')
                    ->label('Tujuan / Pengangkut')
                    ->default(fn($record) => $record->tujuan ?? $record->pengangkut) // Gabung kolom tampilannya
                    ->searchable(),

                TextColumn::make('no_dokumen')
                    ->label('No. Dokumen')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
