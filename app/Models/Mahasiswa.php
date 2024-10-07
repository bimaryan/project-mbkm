<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nim', 'kelas_id', 'email', 'password', 'foto'];
    protected $hidden = ['password'];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
