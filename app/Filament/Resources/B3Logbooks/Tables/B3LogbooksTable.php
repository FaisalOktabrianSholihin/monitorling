<?php

namespace App\Filament\Resources\B3Logbooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class B3LogbooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // ->columns([
            //     TextColumn::make('jenis_limbah')
            //         ->searchable(),
            //     TextColumn::make('tipe_transaksi'),
            //     TextColumn::make('tanggal')
            //         ->date()
            //         ->sortable(),
            //     TextColumn::make('jumlah')
            //         ->numeric()
            //         ->sortable(),
            //     TextColumn::make('sumber_limbah')
            //         ->searchable(),
            //     TextColumn::make('tujuan_vendor')
            //         ->searchable(),
            //     TextColumn::make('no_manifest')
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

                TextColumn::make('jenis_limbah')
                    ->label('Jenis Limbah')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tipe_transaksi')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Masuk' => 'success',
                        'Keluar' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('jumlah')
                    ->label('Jumlah (kg)')
                    ->numeric(2)
                    ->sortable(),

                TextColumn::make('sumber_limbah')
                    ->label('Sumber Limbah')
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyi secara default

                TextColumn::make('tujuan_vendor')
                    ->label('Tujuan (Vendor)')
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyi secara default

                TextColumn::make('no_manifest')
                    ->label('No. Manifest')
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyi secara default
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
