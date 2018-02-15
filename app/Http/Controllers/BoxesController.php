<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Box;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BoxesController extends Controller
{
    public function index()
    {

        $data = DB::table('boxes')->where('department_id', Auth::user()->department_id)->get();
        return view('maintenance/boxes', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'box_identifier' => 'required|min:1',
        ]);

        $boxes = new Box();
        $boxes->box_identifier = $request->box_identifier;
        $boxes->department_id = Auth::user()->department_id;
        $boxes->remember_token = $request->_token;
        $boxes->save();

        $request->session()->flash('alert-success', 'Box Identifier created succesfully');
        return redirect('/boxes');

    }

    public function remove_records(Request $request){

        $table_idx = $_POST['table_idx'];
        DB::table('boxes')->whereIn('id', $table_idx)->delete();

    }
}
