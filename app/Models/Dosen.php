<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';

    protected $fillable = ['name', 'nip', 'keterangan'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'dosen_id');
    }
}
