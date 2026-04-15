<?php

namespace App\Filament\Resources\IpalMonitorings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IpalMonitoringsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('tanggal')
                //     ->date()
                //     ->sortable(),
                // TextColumn::make('ph_inlet')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('ph_outlet')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('status_ph')
                //     ->searchable(),
                // TextColumn::make('suhu')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('debit_pagi')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('debit_sore')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('total_debit')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('warna')
                //     ->searchable(),
                // TextColumn::make('bau')
                //     ->searchable(),
                // TextColumn::make('bahan_kimia')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('ph_inlet')
                    ->label('pH Inlet')
                    ->numeric(2),

                TextColumn::make('ph_outlet')
                    ->label('pH Outlet')
                    ->numeric(2),

                TextColumn::make('status_ph')
                    ->label('Status')
                    ->badge() // Membuat tampilannya seperti label warna-warni
                    ->color(fn(string $state): string => match ($state) {
                        'Normal' => 'success',
                        'Rendah' => 'danger',
                        'Tinggi' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('suhu')
                    ->label('Suhu (°C)')
                    ->numeric(2),

                TextColumn::make('total_debit')
                    ->label('Total Debit (m³)')
                    ->numeric(2)
                    ->sortable(),

                TextColumn::make('bahan_kimia')
                    ->label('Bahan Kimia (kg)')
                    ->numeric(2),

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
