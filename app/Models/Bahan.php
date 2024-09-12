<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = ['bahans'];

    protected $fillable = [
        'users_id',
        'nama_alat',
        'deskripsi',
        'stock',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
