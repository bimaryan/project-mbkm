<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [''];

    public function barang()
    {
        $this->belongsTo(Barang::class, 'jurusan_id');
    }
}
