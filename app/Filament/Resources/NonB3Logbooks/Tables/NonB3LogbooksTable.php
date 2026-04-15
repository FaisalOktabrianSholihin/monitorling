<?php

namespace App\Filament\Resources\NonB3Logbooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NonB3LogbooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori'),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('jenis_limbah')
                    ->searchable(),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('satuan')
                    ->searchable(),
                TextColumn::make('tujuan')
                    ->searchable(),
                TextColumn::make('pengangkut')
                    ->searchable(),
                TextColumn::make('no_dokumen')
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
