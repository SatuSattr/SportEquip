<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsEquipment;

class AdminController extends Controller
{
    public function index()
    {
        $equipment = SportsEquipment::all();
        return view('admin.dashboard', compact('equipment'));
    }
}
