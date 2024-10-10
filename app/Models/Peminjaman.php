<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';

    protected $fillable = [
        'users_id',
        'barang_id',
        'kelas_id',
        'spo_id',
        'rooms_id',
        'dosen_id',
        'matkul',
        'tgl_pinjam',
        'tgl_kembali',
        'keterangan',
        'diserahkan',
        'aprovals',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function spo()
    {
        return $this->belongsTo(SpoDokumen::class, 'spo_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }
}
