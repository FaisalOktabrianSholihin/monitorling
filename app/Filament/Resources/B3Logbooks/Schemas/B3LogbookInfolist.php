<?php

namespace App\Filament\Resources\B3Logbooks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class B3LogbookInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('jenis_limbah'),
                TextEntry::make('tipe_transaksi'),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('jumlah')
                    ->numeric(),
                TextEntry::make('sumber_limbah'),
                TextEntry::make('tujuan_vendor'),
                TextEntry::make('no_manifest'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
