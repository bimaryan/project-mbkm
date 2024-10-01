<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persentase extends Model
{
    use HasFactory;

    protected $fillable = ['satuans_id', 'persentase'];

    public function satuans()
    {
        return $this->belongsTo(Satuan::class, 'satuans_id');
    }
}
