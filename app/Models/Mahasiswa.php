<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Support\Facades\Hash;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nim', 'kelas_id', 'email', 'password', 'foto', 'telepon', 'jenis_kelamin']; 
    protected static function booted()
    {
        static::creating(function ($mahasiswa) {
            $mahasiswa->password = Hash::make('@Poli' . $mahasiswa->nim);
        });
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
