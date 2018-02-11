<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{
    public function index()
    {

        $data = DB::table('departments')->get();
        return view('maintenance/departments', ['data' => json_encode($data)]);
        //return view('maintenance/departments');
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

    public function show(Request $request)
    {
//        $eidentifier = Eidentifier::find($request->input('id'));
//        return response()->json(['response' => $eidentifier->name]);
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
//        $this->validate($request, [
//            'name' => 'required|min:5'
//        ]);
//
//        $eidentifier = Eidentifier::find($id);
//        $eidentifier->update($request->all());
//        $request->session()->flash('alert-success', 'Email name was succesful updated');
//        return redirect('/email_structure');

    }

    public function destroy(Request $request, $id)
    {

//        Eidentifier::find($id)->delete();
//        $request->session()->flash('alert-success', 'Email name was succesful deleted');
//        return redirect('/email_structure');

    }
}
