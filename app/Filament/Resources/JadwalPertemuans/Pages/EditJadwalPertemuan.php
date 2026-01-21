<?php

namespace App\Filament\Resources\JadwalPertemuans\Pages;

use App\Filament\Resources\JadwalPertemuans\JadwalPertemuanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPertemuan extends EditRecord
{
    protected static string $resource = JadwalPertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
