<?php

namespace App\Filament\Resources\JadwalPertemuans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JadwalPertemuanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pendaftaran_id')
                    ->numeric(),
                TextEntry::make('pertemuan_ke')
                    ->numeric(),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('jam')
                    ->time(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
