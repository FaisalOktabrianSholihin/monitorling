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
            ->columns([
                TextColumn::make('jenis_limbah')
                    ->searchable(),
                TextColumn::make('tipe_transaksi'),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sumber_limbah')
                    ->searchable(),
                TextColumn::make('tujuan_vendor')
                    ->searchable(),
                TextColumn::make('no_manifest')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
