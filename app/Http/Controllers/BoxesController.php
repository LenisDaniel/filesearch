<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Box;
use App\Department;
use Illuminate\Support\Facades\DB;

class BoxesController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $data = Box::all();
        return view('maintenance/boxes', ['data' => json_encode($data), 'departments' => $departments]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'box_identifier' => 'required|min:1',
            'department_id' => 'required|not_in:Select One Category',
        ]);

        $boxes = new Box();
        $boxes->box_identifier = $request->box_identifier;
        $boxes->department_id = $request->department_id;
        $boxes->remember_token = $request->_token;
        $boxes->save();

        $request->session()->flash('alert-success', 'Box Identifier created succesfully');
        return redirect('/boxes');

    }

    public function remove_records(Request $request){

        $table_idx = $_POST['table_idx'];
        Box::destroy($table_idx);

    }
}
