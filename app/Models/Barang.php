<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = ['name', 'deskripsi', 'stock', 'users_id', 'kategori_id', 'satuan_id', 'room_id', 'kondisi_id', 'gambar'];

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'barang_id', 'id');
    }
}
