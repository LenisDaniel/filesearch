<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archive;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArchivesController extends Controller
{
    public function index()
    {
        $data = DB::table('archives')->where('department_id', Auth::user()->department_id)->get();
        return view('maintenance/archives', ['data' => json_encode($data)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'archive_identifier' => 'required|min:1',
        ]);

        $archives = new Archive();
        $archives->archive_identifier = $request->archive_identifier;
        $archives->department_id = Auth::user()->department_id;

        $archives->remember_token = $request->_token;
        $archives->save();

        $request->session()->flash('alert-success', 'Archive created succesfully');
        return redirect('/archives');

    }

    public function remove_records(Request $request){

        $table_idx = $_POST['table_idx'];
        Archive::destroy($table_idx);

    }
}
