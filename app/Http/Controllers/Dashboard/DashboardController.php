<?php

namespace App\Http\Controllers\Dashboard;

class DashboardController extends Controller
{
    public function create(){
        return view('dashboard.dashboard');
    }
}
