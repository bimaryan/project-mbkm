<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;

    protected $table = 'kondisis';

    protected $fillable = ['kondisi'];


    public function barang() {
        return $this->hasMany(Barang::class);
    }
}
