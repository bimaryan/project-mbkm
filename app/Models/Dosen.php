<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';

    protected $fillable = ['nama_dosen', 'nip'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'dosen_id');
    }
}
