<?php

namespace App\Filament\Resources\JadwalPertemuans\Pages;

use App\Filament\Resources\JadwalPertemuans\JadwalPertemuanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJadwalPertemuan extends ViewRecord
{
    protected static string $resource = JadwalPertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
