<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CitiesController extends Controller
{
    public function index()
    {
        $data = DB::table('cities')->where('department_id', Auth::user()->department_id)->get();
        return view('maintenance/cities', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'city_name' => 'required|min:5',
        ]);

        $cities = new City();
        $cities->city_name = $request->city_name;
        $cities->department_id = Auth::user()->department_id;
        $cities->remember_token = $request->_token;
        $cities->save();

        $request->session()->flash('alert-success', 'City created succesfully');
        return redirect('/cities');

    }

    public function remove_records(Request $request)
    {

        $table_idx = $_POST['table_idx'];
        DB::table('cities')->whereIn('id', $table_idx)->delete();


    }

}
