<?php

namespace App\Filament\Resources\B3Inspections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class B3InspectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('petugas')
                    ->label('Petugas')
                    ->searchable(),

                TextColumn::make('shift')
                    ->label('Shift')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pagi' => 'info',
                        'Siang' => 'warning',
                        'Malam' => 'gray',
                        default => 'gray',
                    }),

                // Menghitung jumlah temuan dari tabel detail
                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Jumlah Temuan')
                    ->badge(),
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
