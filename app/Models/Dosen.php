<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';

    protected $fillable = ['name', 'nip', 'keterangan', 'users_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'dosen_id');
    }
}
