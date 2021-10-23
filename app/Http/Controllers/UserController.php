<?php

namespace App\Http\Controllers;


// use App\DataTables\UsersDataTable;

use App\Imports\UserImport;
use App\Models\User;
use App\Models\Section;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('index', User::class);

        // if ($request->ajax()) {
        //     $model = User::with('section', 'position');
        //             return Datatables::eloquent($model)
        //             ->addColumn('positions', function (User $user) {
        //                 return $user->position->nama_jabatan;
        //             })
        //             ->toJson();
        // }
        return view('users.index');

        // return $dataTable->render('users.index');
        // $users = User::all();
        // return view('users.index', [
        //     'users' => $users
        // ]);
    }

    public function getUsers()
    {
        $position = Auth::user()->position->nama_jabatan;
        if ($position == "Kepala Seksi") {
            $users = User::with(['position', 'section'])->select(['id', 'name', 'nip', 'position_id', 'section_id'])->where('section_id', Auth::user()->section_id);

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $edit = url('user/edit/' . $data->id);
                // $delete = url('user/delete/'.$data->id);
                $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);    
        } elseif ($position == "Operator Console") {
            $users = User::with(['position', 'section'])->select(['id', 'name', 'nip', 'position_id', 'section_id']);

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $edit = url('user/edit/' . $data->id);
                // $delete = url('user/delete/'.$data->id);
                $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
    }

    public function formImport()
    {
        $this->authorize('create', User::class);

        return view('users.form-import');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file')->store('import');

        $import = new UserImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->back()->with('success', 'Data Pengguna berhasil di import.');
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $sections = Section::all();
        $positions = Position::all();
        // $positions = User::whereHas('position', function($query) {
        //     return $query->where('position_id', '1');
        // })->get();

        return view('users.create', [
            'sections' => $sections,
            'positions' => $positions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'nip' => ['numeric', 'unique:users,nip'],
            'email' => ['required', 'email', 'unique:users,email'],
            'section_id' => ['required'],
            'position_id' => ['required'],
            'password' => ['required', 'min:8']
        ]);

        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'section_id' => $request->section_id,
            'position_id' => $request->position_id,
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Data pengguna berhasil ditambah.');
    }

    public function edit(User $user)
    {
        $this->authorize('edit', User::class);

        $sections = Section::all();
        $positions = Position::all();

        return view('users.edit', [
            'user' => $user,
            'sections' => $sections,
            'positions' => $positions,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'nip' => 'required|numeric|unique:users,nip,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'section_id' => ['required'],
            'position_id' => ['required']
        ]);

        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'email' => $request->email,
                'section_id' => $request->section_id,
                'position_id' => $request->position_id,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'email' => $request->email,
                'section_id' => $request->section_id,
                'position_id' => $request->position_id,
            ]);
        }

        return back()->with('success', 'Data pengguna berhasil diubah.');
    }

    public function destroy(Request $request, User $user)
    {
        $user_id = $request->user_id;

        $query = User::find($user_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'message' => 'Data pengguna berhasil dihapus']);
        } else {
            return response()->json(['code' => 0, 'message' => 'Data pengguna tidak berhasil dihapus']);
        }
    }
}
