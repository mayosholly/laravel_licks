<?php

namespace App\Http\Controllers;

use App\Events\Register;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Jobs\SendEmail;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        // SendEmail::dispatch($users);
        return view('users/index', [
            'users' => $users
        ]);
    }

    public function create(){
        return view('users/create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::create($validated);
        if($user){
            SendEmail::dispatch($user);
        }
        // if($user){
        //     event(new Register($user));
        // }
        return redirect()->route('user.index');
    }

    public function uploadExcel(Request $request){
        $request->validate([
            'excel_sheet' => ['required', 'file', 'mimes:csv,xlsx,txt']
        ]);
        try {
            Excel::import(new UsersImport, $request->file('excel_sheet'));
        return back();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $th) {
            $failures = $th->failures();
            return back()->with('import_errors', $failures);
        }
            
    }

    public function downloadExcel() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function download(){
        $users = User::get();
        $pdf = PDF::loadView('pdf.users', [
            'users' => $users
        ] );
        // return $pdf->stream('users.pdf');
        return $pdf->download('users.pdf');
    }

    public function fetchUsers(){
        $items = [[
            'name' => 'ma',
            'email' => 'mas@sad.c',
            'password' => '1212',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'ma1',
            'email' => 'ma1s@sad.c',
            'password' => '1212',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'ma2',
            'email' => 'ma2s@sad.c',
            'password' => '1212',
            'created_at' => now(),
            'updated_at' => now()
        ]];
        $items = collect($items);
        $chunks = $items->chunk(2);
        foreach($chunks as $item){
            // DB::table('users')->insert($item->toArray());
            User::insert($item->toArray());
        }
        return 'success'; 
    }
}
