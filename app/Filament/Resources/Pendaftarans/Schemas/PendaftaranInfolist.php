<?php

namespace App\Filament\Resources\Pendaftarans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PendaftaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('paket'),
                TextEntry::make('total_pertemuan')
                    ->numeric(),
                TextEntry::make('sisa_pertemuan')
                    ->numeric(),
                TextEntry::make('nama_lengkap'),
                TextEntry::make('tempat_lahir'),
                TextEntry::make('tanggal_lahir')
                    ->date(),
                TextEntry::make('alamat')
                    ->columnSpanFull(),
                TextEntry::make('jenis_kelamin'),
                TextEntry::make('pekerjaan'),
                TextEntry::make('mobil_dipilih'),
                TextEntry::make('metode_pembayaran'),
                TextEntry::make('opsi_kredit')
                    ->placeholder('-'),
                TextEntry::make('pas_foto_url')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('ktp_url')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('harga')
                    ->numeric(),
                TextEntry::make('tanggal_daftar')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('tipe_pendaftaran')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('status_pendaftaran')
                    ->badge(),
            ]);
    }
}
