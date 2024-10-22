<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function ruangan() {
        $ruangan = Room::all();
        Room::paginate(10);
        return view("admin.ruangan.index", ["ruangan"=> $ruangan]);
    }
}
