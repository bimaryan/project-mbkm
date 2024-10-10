<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('admin.peminjaman.index');
    }

    public function peminjaman(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            ''
        ]);
    }
}
