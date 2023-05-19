<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones =DB::table('zones')->where('is_active', true)->get();
        $energyTypes =DB::table('energy_types')->where('is_active', true)->get();
        return view('home', compact('zones', 'energyTypes'));
    }
}
