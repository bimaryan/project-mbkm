<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';

    protected $fillable = [
        'mahasiswa_id',
        'barang_id',
        'stock_id',
        'spo_id',
        'rooms_id',
        'matkul_id',
        'stock_pinjam',
        'QR',
        'tgl_pinjam',
        'waktu_kembali',
        'keterangan',
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

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'matkul_id');
    }
}
