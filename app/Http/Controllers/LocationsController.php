<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\DB;

class LocationsController extends Controller
{
    public function index()
    {
        $data = Location::all();
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

    public function remove_records(Request $request){

        $table_idx = $_POST['table_idx'];
        Location::destroy($table_idx);

    }
}