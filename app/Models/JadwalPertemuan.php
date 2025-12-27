<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPertemuan extends Model
{
    protected $table = 'jadwal_pertemuan';

    protected $fillable = [
        'pendaftaran_id',
        'pertemuan_ke',
        'tanggal',
        'jam',
        'status'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
