<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Storing;


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


    public function index()
    {

        $data = DB::table('storings')
            ->join('departments', 'departments.id' , '=', 'storings.department_id')
            ->join('cities', 'cities.id' , '=', 'storings.cities_id')
            ->join('locations', 'locations.id' , '=', 'storings.location_id')
            ->join('archives', 'archives.id' , '=', 'storings.archive_id')
            ->join('boxes', 'boxes.id' , '=', 'storings.box_id')
            ->select('storings.*', 'departments.department_name', 'cities.city_name', 'locations.location_name', 'archives.archive_identifier', 'boxes.box_identifier')
            ->where('storings.department_id', '=', Auth::user()->department_id)
            ->get();

        return view('/home', ['data' => json_encode($data)]);
        ///return view('/sellbook', ['data' => $data]);

    }



}
