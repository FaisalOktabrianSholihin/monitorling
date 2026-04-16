<?php

namespace App\Filament\Resources\B3Logbooks\Pages;

use App\Filament\Resources\B3Logbooks\B3LogbookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListB3Logbooks extends ListRecords
{
    protected static string $resource = B3LogbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Semua' => Tab::make(),
            'Limbah Masuk' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tipe_transaksi', 'Masuk'))
                ->icon('heroicon-m-arrow-down-tray'),
            'Limbah Keluar' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tipe_transaksi', 'Keluar'))
                ->icon('heroicon-m-arrow-up-tray'),
        ];
    }
}
