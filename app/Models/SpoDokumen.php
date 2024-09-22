<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpoDokumen extends Model
{
    use HasFactory;

    protected $table = 'spo_dokumens';

    protected $fillable = ['name', 'kategori_id', 'file'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
