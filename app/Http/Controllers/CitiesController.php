<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    public function index()
    {
        $data = DB::table('cities')->get();
        return view('maintenance/cities', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'city_name' => 'required|min:5'
        ]);

        $cities = new City();

        $cities->city_name = $request->city_name;
        $cities->remember_token = $request->_token;
        $cities->save();

        $request->session()->flash('alert-success', 'City created succesfully');
        return redirect('/cities');

    }

}
