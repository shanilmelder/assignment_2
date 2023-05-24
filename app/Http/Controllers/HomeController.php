<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\EnergyType;

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
        $zones = Zone::where('is_active', true)->get();
        $energyTypes = EnergyType::where('is_active', true)->get();
        return view('home', compact('zones', 'energyTypes'));
    }
}
