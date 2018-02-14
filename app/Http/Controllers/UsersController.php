<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

    public function index()
    {
        $data = User::all();
        return view('maintenance/users', ['data' => json_encode($data), 'process' => 0]);
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
        User::destroy($table_idx);

    }


    public function show($id)
    {


        //Venimos a este metodo para presentar el usuario a editar
        $data = User::all();
        $user_data = User::find($id);



        return view('maintenance/users', ['data' => json_encode($data), 'user_data' => $user_data, 'process' => 1]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
