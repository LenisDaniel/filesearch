<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archive;
use Illuminate\Support\Facades\DB;

class ArchivesController extends Controller
{
    public function index()
    {
        $data = DB::table('archives')->get();
        return view('maintenance/archives', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'archive_identifier' => 'required|min:1'
        ]);

        $archives = new Archive();

        $archives->archive_identifier = $request->archive_identifier;
        $archives->remember_token = $request->_token;
        $archives->save();

        $request->session()->flash('alert-success', 'Archive created succesfully');
        return redirect('/archives');

    }
}
