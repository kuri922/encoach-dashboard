<?php

namespace App\Http\Controllers\Dashboard;
use App\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminslistController extends Controller
{
    public function index(Request $request) {
    $admins = Admin :: paginate(15);

    return view('dashboard.admins.index' , compact('admins'));
}
}
