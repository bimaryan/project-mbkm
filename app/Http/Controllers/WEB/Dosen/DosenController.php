<?php

namespace App\Http\Controllers\WEB\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        return view('dosen.index');
    }
}
