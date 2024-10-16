<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = ['nama_barang', 'kategori_id', 'satuan_id',  'kondisi_id', 'foto'];

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }



    public function stock()
    {
        return $this->hasOne(Stock::class, 'barang_id', 'id');
    }
}
