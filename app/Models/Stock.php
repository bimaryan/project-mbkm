<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'stock'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
