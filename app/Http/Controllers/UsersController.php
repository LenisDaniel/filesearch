<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;

class UsersController extends Controller
{

    public function index()
    {
        $data = User::all();
        $departments = Department::all();
        return view('maintenance/users', ['data' => json_encode($data), 'departments' => $departments, 'process' => 0]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function remove_records(Request $request){

        $table_idx = $_POST['table_idx'];
        DB::table('users')->whereIn('id', $table_idx)->delete();

    }

    public function show($id)
    {
        $data = User::all();
        $user_data = User::find($id);
        $departments = Department::all();

        return view('maintenance/users', ['data' => json_encode($data), 'user_data' => $user_data, 'departments' => $departments, 'process' => 1]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if($id == 0){
            $request->session()->flash('alert-success', 'User does not exist, to edit it must be one of the list.');
            return redirect('/users');
        }
        $is_admin = (isset($request['is_admin'])) ? 1 : 0;

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $users = User::find($id);

        $users->name = $request->name;
        $users->email = $request->email;
        $users->is_admin = $is_admin;
        $users->save();

        $request->session()->flash('alert-success', 'User Updated succesfully');
        return redirect('/users');

    }

    public function destroy($id)
    {
        //
    }
}
