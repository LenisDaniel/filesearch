<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Box;
use Illuminate\Support\Facades\DB;

class BoxesController extends Controller
{
    public function index()
    {
        $data = DB::table('boxes')->get();
        return view('maintenance/boxes', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'box_identifier' => 'required|min:1'
        ]);

        $boxes = new Box();

        $boxes->box_identifier = $request->box_identifier;
        $boxes->remember_token = $request->_token;
        $boxes->save();

        $request->session()->flash('alert-success', 'Box Identifier created succesfully');
        return redirect('/boxes');

    }
}
