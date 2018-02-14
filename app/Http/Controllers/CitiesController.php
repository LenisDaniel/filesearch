<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Department;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $data = City::all();
        return view('maintenance/cities', ['data' => json_encode($data), 'departments' => $departments]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'city_name' => 'required|min:5',
            'department_id' => 'required|not_in:Select One Category',
        ]);

        $cities = new City();
        $cities->city_name = $request->city_name;
        $cities->department_id = $request->department_id;
        $cities->remember_token = $request->_token;
        $cities->save();

        $request->session()->flash('alert-success', 'City created succesfully');
        return redirect('/cities');

    }

    public function remove_records(Request $request){

        $table_idx = $_POST['table_idx'];
        City::destroy($table_idx);

    }

}
