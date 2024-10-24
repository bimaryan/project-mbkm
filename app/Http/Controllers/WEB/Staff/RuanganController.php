<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Imports\RuanganImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class RuanganController extends Controller
{
    public function ruangan()
    {
        $ruangan = Room::paginate(5);
        return view("pageStaff.ruangan.index", ["ruangan" => $ruangan]);
    }

    public function storeRuangan(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string'
        ]);

        Room::create([
            'nama_ruangan' => $request->nama_ruangan
        ]);

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function editRuangan(Request $request, Room $ruangan)
    {
        $request->validate([
            'nama_ruangan' => 'required|string'
        ]);

        $ruangan->update([
            'nama_ruangan' => $request->nama_ruangan
        ]);

        return redirect()->back()->with('success', 'Ruangan berhasil diperbarui!');
    }

    public function deleteRuangan(Room $ruangan)
    {
        $ruangan->delete();

        return redirect()->back()->with('success', 'Ruangan berhasil dihapus!');
    }

    public function importRuangan(Request $request)
    {
        Excel::import(new RuanganImport(), $request->file('file'));
        return redirect()->back()->with('success', 'Ruangan berhasil diimport!');
    }
}
