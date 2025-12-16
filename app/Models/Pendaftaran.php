<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    // Menggunakan trait ini adalah praktik yang baik
    use HasFactory;
    
    // Wajib: Karena nama tabel Anda adalah 'pendaftaran' (bukan 'pendaftarans')
    protected $table = 'pendaftaran';
    
    // Wajib: Agar bisa menggunakan Mass Assignment (mengisi data melalui $model->create())
 protected $fillable = [
    'user_id',
    'nama_lengkap',
    'tempat_lahir',
    'tanggal_lahir',
    'alamat',
    'jenis_kelamin',
    'pekerjaan',
    'mobil_dipilih',
    'paket',
    'harga',
    'metode_pembayaran',
    'tanggal_daftar',
];


    // Relasi 1: User (Siapa yang mendaftar)
    // Foreign Key: user_id
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relasi 2: Transaksi (Status Pembayaran Midtrans)
     * Foreign Key: pendaftaran_id (ada di tabel transactions)
     * * PENTING: Kita perlu menambahkan nama foreign key di sini
     * jika relasi tidak mengikuti konvensi nama.
     */
    public function transaction()
    {
        // Parameter kedua adalah nama foreign key di tabel 'transactions'
        return $this->hasOne(Transaction::class, 'pendaftaran_id'); 
    }
}