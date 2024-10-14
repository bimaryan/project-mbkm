<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = ['barang_id', 'stock', 'stock_pinjam', 'stock_hilang'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
