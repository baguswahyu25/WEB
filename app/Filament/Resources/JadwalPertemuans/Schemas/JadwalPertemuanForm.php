<?php

namespace App\Filament\Resources\JadwalPertemuans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class JadwalPertemuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pendaftaran_id')
                    ->required()
                    ->numeric(),
                TextInput::make('pertemuan_ke')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal')
                    ->required(),
                TimePicker::make('jam')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
