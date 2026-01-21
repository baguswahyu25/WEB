<?php

namespace App\Filament\Resources\JadwalPertemuans\Pages;

use App\Filament\Resources\JadwalPertemuans\JadwalPertemuanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPertemuans extends ListRecords
{
    protected static string $resource = JadwalPertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
