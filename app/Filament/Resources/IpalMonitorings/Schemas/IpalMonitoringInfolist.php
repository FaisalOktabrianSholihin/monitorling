<?php

namespace App\Filament\Resources\IpalMonitorings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class IpalMonitoringInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('ph_inlet')
                    ->numeric(),
                TextEntry::make('ph_outlet')
                    ->numeric(),
                TextEntry::make('status_ph'),
                TextEntry::make('suhu')
                    ->numeric(),
                TextEntry::make('debit_pagi')
                    ->numeric(),
                TextEntry::make('debit_sore')
                    ->numeric(),
                TextEntry::make('total_debit')
                    ->numeric(),
                TextEntry::make('warna'),
                TextEntry::make('bau'),
                TextEntry::make('bahan_kimia')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
