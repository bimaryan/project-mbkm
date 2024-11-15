<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linkapis extends Model
{
    use HasFactory;

    protected $table = 'link_apis';

    protected $fillable = ['link_api'];
}
