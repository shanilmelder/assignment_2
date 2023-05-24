<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EnergyType;
use App\Sale;
use App\VolumeHistory;
use App\Purchase;

class TradingController extends Controller
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
        $energyTypes = EnergyType::where('is_active', true)->get();
        return view('tradingmaster', compact('energyTypes'));
    }

    public function save(Request $request)
    {
        if(request('id') == "-9999"){
            $energyType = new EnergyType();
            $energyType->description = request('description');
            $energyType->market_price = request('market_price');
            $energyType->admin_fee = request('admin_fee');
            $energyType->tax_rate = request('tax_rate');
            $energyType->is_active = true;
            $energyType->save();
        }else {
            $energyType = EnergyType::find(request('id'));
            $energyType->description = request('description');
            $energyType->market_price = request('market_price');
            $energyType->admin_fee = request('admin_fee');
            $energyType->tax_rate = request('tax_rate');
            $energyType->is_active = true;
            $energyType->update();
        }

        return redirect('/trading-master');
    }

    public function delete(Request $request)
    {
        $energyType = EnergyType::find(request('id'));
        $energyType-> delete();

        return redirect('/trading-master');
    }

    public function trading()
    {
        $sales = Sale::all();
        $energyTypes = EnergyType::where('is_active', true)->get();
        $volumeHistory = VolumeHistory::all();
        return view('trading', compact('sales', 'energyTypes', 'volumeHistory'));
    }

    public function sell(Request $request)
    {
        $sale = new Sale();
        $sale->energy_type_id = request('id');
        $sale->volume = request('volume');
        $sale->price = request('price');
        $sale->user_id = auth()->user()->id;
        $sale->save();

        $volumeHistory = VolumeHistory::where('user_id', auth()->user()->id)->where('energy_type_id', request('id'))->first();
        if($volumeHistory == null)
        {
            $volumeHistory = new VolumeHistory();
            $volumeHistory->energy_type_id = request('id');
            $volumeHistory->available_volume = request('volume');
            $volumeHistory->user_id = auth()->user()->id;
            $volumeHistory->save();
        }
        else
        {
            $volumeHistory->available_volume =  $volumeHistory->available_volume + request('volume');
            $volumeHistory->update();
        }
    }

    public function buy(Request $request)
    {
        $purchase = new Purchase();
        $purchase->energy_type_id = request('id');
        $purchase->volume = request('volume');
        $purchase->user_id = auth()->user()->id;
        $purchase->save();

        $volumeHistory = VolumeHistory::where('user_id', auth()->user()->id)->where('energy_type_id', request('id'))->first();
        if($volumeHistory == null)
        {
            $volumeHistory = new VolumeHistory();
            $volumeHistory->energy_type_id = request('id');
            $volumeHistory->available_volume = request('volume');
            $volumeHistory->user_id = auth()->user()->id;
            $volumeHistory->save();
        }
        else
        {
            $volumeHistory->available_volume =  $volumeHistory->available_volume - request('volume');
            $volumeHistory->update();
        }
    }
}
