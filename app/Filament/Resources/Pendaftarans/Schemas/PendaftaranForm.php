<?php

namespace App\Filament\Resources\Pendaftarans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PendaftaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('paket')
                    ->required(),
                TextInput::make('total_pertemuan')
                    ->required()
                    ->numeric(),
                TextInput::make('sisa_pertemuan')
                    ->required()
                    ->numeric(),
                TextInput::make('nama_lengkap')
                    ->required(),
                TextInput::make('tempat_lahir')
                    ->required(),
                DatePicker::make('tanggal_lahir')
                    ->required(),
                Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('jenis_kelamin')
                    ->required(),
                TextInput::make('pekerjaan')
                    ->required(),
                TextInput::make('mobil_dipilih')
                    ->required(),
                TextInput::make('metode_pembayaran')
                    ->required(),
                TextInput::make('opsi_kredit'),
                Textarea::make('pas_foto_url')
                    ->columnSpanFull(),
                Textarea::make('ktp_url')
                    ->columnSpanFull(),
                TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('tanggal_daftar'),
                Select::make('tipe_pendaftaran')
                    ->options(['sim' => 'Sim', 'non_sim' => 'Non sim'])
                    ->default('non_sim')
                    ->required(),
                Select::make('status_pendaftaran')
                    ->options(['aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'])
                    ->default('aktif')
                    ->required(),
            ]);
    }
}
