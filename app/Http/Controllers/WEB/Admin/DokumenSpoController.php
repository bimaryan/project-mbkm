<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class DokumenSpoController extends Controller
{
    public function index()
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $query = Admin::query();

        $users = $query->paginate(5);
        $role = Role::all();

        return view('pageAdmin.dokumenspo.index', ['user' => $users, 'notifikasiPeminjaman' => $notifikasiPeminjaman], ['role' => $role]);
    }
}
