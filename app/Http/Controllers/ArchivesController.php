<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archive;
use App\Department;
use Illuminate\Support\Facades\DB;

class ArchivesController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $data = Archive::all();
        return view('maintenance/archives', ['data' => json_encode($data), 'departments' => $departments]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'archive_identifier' => 'required|min:1',
            'department_id' => 'required|not_in:Select One Category'
        ]);

        $archives = new Archive();
        $archives->archive_identifier = $request->archive_identifier;
        $archives->department_id = $request->department_id;
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
