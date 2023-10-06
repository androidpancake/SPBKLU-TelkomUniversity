<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        return view('api.monitor');
    }

    public function guide1()
    {
        return view('api.guide1');
    }
}
