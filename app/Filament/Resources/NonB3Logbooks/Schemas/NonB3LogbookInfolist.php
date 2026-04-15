<?php

namespace App\Filament\Resources\NonB3Logbooks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class NonB3LogbookInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kategori'),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('jenis_limbah'),
                TextEntry::make('jumlah')
                    ->numeric(),
                TextEntry::make('satuan'),
                TextEntry::make('tujuan'),
                TextEntry::make('pengangkut'),
                TextEntry::make('no_dokumen'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
