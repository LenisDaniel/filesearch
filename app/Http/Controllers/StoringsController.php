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

        return view('storing', ['departments' => $departments, 'cities' => $cities, 'locations' => $locations, 'archives' => $archives, 'boxes' => $boxes, 'process' => 0, 'dep_id' => 0, 'cit_id' => 0, 'loc_id' => 0, 'arc_id' => 0, 'box_id' => 0]);
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

    public function show($id)
    {
        $data = Storing::find($id);
        $dep_id = Department::find($data->department_id);
        $cit_id = City::find($data->cities_id);
        $loc_id = Location::find($data->location_id);
        $arc_id = Archive::find($data->archive_id);
        $box_id = Box::find($data->box_id);

        $departments = Department::all();
        $cities = City::all();
        $locations = Location::all();
        $archives = Archive::all();
        $boxes = Box::all();

        return view('storing', ['data' => $data, 'departments' => $departments, 'cities' => $cities, 'locations' => $locations, 'archives' => $archives, 'boxes' => $boxes, 'process' => 1, 'dep_id' => $dep_id->id, 'cit_id' => $cit_id->id, 'loc_id' => $loc_id->id, 'arc_id' => $arc_id->id, 'box_id' => $box_id->id]);
    }

    public function update(Request $request, $id)
    {
        $out = (isset($request['out'])) ? 1 : 0;
        $this->validate($request, [
            'case_number' => 'required|min:5',
            'department_id' => 'required|not_in:Select One',
            'city_id' => 'required|not_in:Select One Category',
            'location_id' => 'required|not_in:Select One Category',
            'archive_id' => 'required|not_in:Select One Category',
            'box_id' => 'required|not_in:Select One Category',
        ]);

        $storings = Storing::find($id);
        $storings->case_number = $request->case_number;
        $storings->department_id = $request->department_id;
        $storings->cities_id = $request->city_id;
        $storings->location_id = $request->location_id;
        $storings->archive_id = $request->archive_id;
        $storings->box_id = $request->box_id;
        $storings->out = $out;
        $storings->comments = $request->comments;
        $storings->remember_token = $request->_token;
        $storings->save();

        $request->session()->flash('alert-success', 'Case Updated succesfully');
        return redirect('/storing');


    }

}
