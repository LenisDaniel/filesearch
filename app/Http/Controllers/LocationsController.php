<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\DB;

class LocationsController extends Controller
{
    public function index()
    {
        $data = DB::table('locations')->get();
        return view('maintenance/locations', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required|min:5'
        ]);

        $locations = new Location();

        $locations->location_name = $request->location_name;
        $locations->remember_token = $request->_token;
        $locations->save();

        $request->session()->flash('alert-success', 'Location created succesfully');
        return redirect('/locations');

    }
}
