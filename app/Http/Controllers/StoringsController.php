<?php

namespace App\Http\Controllers;

use App\Storing;
use Illuminate\Http\Request;
use App\Archive;
use App\Box;
use App\City;
use App\Department;
use App\Location;

class StoringsController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $cities = City::all();
        $locations = Location::all();
        $archives = Archive::all();
        $boxes = Box::all();

        return view('storing', ['departments' => $departments, 'cities' => $cities, 'locations' => $locations, 'archives' => $archives, 'boxes' => $boxes]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'case_number' => 'required|min:5',
            'department_id' => 'required|not_in:Select One Category',
            'city_id' => 'required|not_in:Select One Category',
            'location_id' => 'required|not_in:Select One Category',
            'archive_id' => 'required|not_in:Select One Category',
            'box_id' => 'required|not_in:Select One Category',
        ]);

        $storings = new Storing();
        $storings->case_number = $request->case_number;
        $storings->department_id = $request->department_id;
        $storings->cities_id = $request->city_id;
        $storings->location_id = $request->location_id;
        $storings->archive_id = $request->archive_id;
        $storings->box_id = $request->box_id;
        $storings->remember_token = $request->_token;
        $storings->save();

        $request->session()->flash('alert-success', 'Case save succesfully');
        return redirect('/storing');

    }
}
