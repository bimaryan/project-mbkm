<?php

namespace App\Http\Controllers\WEB\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.index');
    }
}
