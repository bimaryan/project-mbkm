<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Linkapis;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkApiController extends Controller
{
    public function index()  // For listing LinkApi records
    {
        $notifikasiPeminjaman = Peminjaman::with(['mahasiswa', 'barang'])
            ->where('status', '!=', 'Dikembalikan')
            ->latest()
            ->take(5)
            ->get();

        $linkapi = Linkapis::get();
        return view('pageAdmin.peraturan.linkapi.index', compact('linkapi', 'notifikasiPeminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link_api' => 'required|string',
        ]);

        Linkapis::create([
            'link_api' => $request->link_api,
        ]);

        return redirect()->back()->with('success', 'Link API berhasil ditambahkan.');
    }

    public function update(Request $request, Linkapis $link_api)
    {
        $request->validate([
            'link_api' => 'required|string',
        ]);

        $link_api->update([
            'link_api' => $request->link_api,
        ]);

        return redirect()->back()->with('success', 'Link API berhasil diperbarui.');
    }

    public function destroy(Linkapis $link_api)
    {
        $link_api->delete();

        return redirect()->back()->with('success', 'Link API berhasil dihapus.');
    }
}
