<?php

namespace App\Http\Controllers\WEB\Peminjaman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index() {
        return view('mahasiswa.keranjang.index');
    }
}
