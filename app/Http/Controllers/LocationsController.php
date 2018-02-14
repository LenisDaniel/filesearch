<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LocationsController extends Controller
{
    public function index()
    {
        $data = DB::table('locations')->where('department_id', Auth::user()->department_id)->get();
        return view('maintenance/locations', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required|min:5',
        ]);

        $locations = new Location();
        $locations->location_name = $request->location_name;
        $locations->department_id = Auth::user()->department_id;
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
