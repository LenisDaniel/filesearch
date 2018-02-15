<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{
    public function index()
    {
        //$data = Department::all();
        //return view('maintenance/departments', ['data' => json_encode($data)]);
        return redirect('/home');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'department_name' => 'required|min:5'
        ]);

        $department = new Department();

        $department->department_name = $request->department_name;
        $department->remember_token = $request->_token;
        $department->save();

        $request->session()->flash('alert-success', 'Department created succesfully');
        return redirect('/departments');

    }

    public function remove_records(Request $request){

        $table_idx = $_POST['table_idx'];
        DB::table('departments')->whereIn('id', $table_idx)->delete();

    }

    public function show(Request $request)
    {

    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {


    }

    public function destroy(Request $request, $id)
    {



    }
}
