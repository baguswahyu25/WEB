<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketKursus extends Model
{
    use HasFactory;
    protected $table = 'paket_kursus';
    protected $fillable = ['nama','harga','tipe','is_active'];
}
