<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\InventoryResource;
use Filament\Pages\Actions\Action;

class ListInventories extends ListRecords
{
    protected static string $resource = InventoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('Kelola Barang dan Laporan')
            ->url(route('kelola.laporan')),
        ];
    }
}
