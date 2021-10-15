<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaxpayerRequest;
use App\Models\Taxpayer;
use Illuminate\Http\Request;
use App\Imports\TaxpayerImport;
use App\Imports\TaxpayerUpdateImport;
use App\Models\Position;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class TaxpayerController extends Controller
{
    public function index()
    {
        $users = User::where('position_id', '5')->pluck('name')->unique();
        $sections = Section::pluck('nama_seksi')->unique();
        return view('taxpayers.index', compact('users', 'sections'));

        // if (Auth::user()->position->nama_jabatan == "Account Representative") {
        //     $taxpayers = Taxpayer::where('user_id', Auth::id())->get();
        //     return view('taxpayers.index', compact('taxpayers'));
        // } elseif (Auth::user()->position->nama_jabatan == "Pelaksana Seksi") {
        //     $taxpayers = Taxpayer::where('pelaksana_id', Auth::id())->get();
        //     return view('taxpayers.index', compact('taxpayers'));
        // } elseif (Auth::user()->position->nama_jabatan == "Kepala Seksi") {
        //     $taxpayers = Taxpayer::where('kasi_id', Auth::id())->get();
        //     return view('taxpayers.index', compact('taxpayers'));
        // } elseif (Auth::user()->position->nama_jabatan == "Kepala Kantor") {
        //     $taxpayers = Taxpayer::all();
        //     return view('taxpayers.index', compact('taxpayers'));
        // } else {
        //     $taxpayers = Taxpayer::all();
        //     $users = User::where('position_id', '5')->unique()->pluck('name');
        //     return view('taxpayers.index', compact('taxpayers'));
        //     // $taxpayers = Taxpayer::where('user_id', Auth::id())->get();
        //     // return view('taxpayers.index', compact('taxpayers'));
        // }
        // $taxpayers = Taxpayer::all();
        // $taxpayers = auth()->user()->taxpayer ?? Taxpayer::all();
        // return view('taxpayers.index', compact('taxpayers'));
    }

    public function taxpayerData()
    {
        if (Auth::user()->position->nama_jabatan == "Account Representative") {
            $taxpayers = Taxpayer::with(['user.section', 'kasi'])->where('user_id', Auth::id())->get();

            return DataTables::of($taxpayers)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $edit = url('taxpayer/edit/' . $data->id);
                $delete = url('taxpayer/delete/'.$data->id);
                $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                $button .= '<a href="'.$delete.'" class="btn btn-danger">Hapus</a>';

                return $button;
            })
            ->addColumn('checkbox', function($data){
                return '<input type="checkbox" name="taxpayer_checkbox" data-id="'.$data->id.'">';
            })
            ->rawColumns(['action', 'checkbox'])
            ->make(true);
        } elseif (Auth::user()->position->nama_jabatan == "Kepala Seksi") {
            $taxpayers = Taxpayer::with(['user.section', 'kasi'])->where('kasi_id', Auth::id())->get();

            return DataTables::of($taxpayers)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $edit = url('taxpayer/edit/' . $data->id);
                $delete = url('taxpayer/delete/'.$data->id);
                $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

                return $button;
            })
            ->addColumn('checkbox', function($data){
                return '<input type="checkbox" name="taxpayer_checkbox" data-id="'.$data->id.'">';
            })
            ->rawColumns(['action', 'checkbox'])
            ->make(true);
        } else {
            $taxpayers = Taxpayer::with(['user.section', 'kasi'])->get();

            return DataTables::of($taxpayers)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $edit = url('taxpayer/edit/' . $data->id);
                $delete = url('taxpayer/delete/'.$data->id);
                $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

                return $button;
            })
            ->addColumn('checkbox', function($data){
                return '<input type="checkbox" name="taxpayer_checkbox" data-id="'.$data->id.'">';
            })
            ->rawColumns(['action', 'checkbox'])
            ->make(true);
        }
    }

    public function formUpdateImport()
    {
        $this->authorize('import', Taxpayer::class);
        return view('taxpayers.form-update-import');
    }

    public function importUpdate(Request $request)
    {
        $this->validate($request, [
            'file' => 'mimes:xlsx,xls'
        ]);

        Excel::import(new TaxpayerUpdateImport, $request->file('file'));

        return redirect()->back()->with('success', 'Berhasil update data wajib pajak.');

        // $this->validate($request, [
        //     'file' => 'required|mimes:xlsx,xls'
        // ]);

        // $file = $request->file('file')->store('import');

        // $import = new TaxpayerUpdateImport;
        // $import->import($file);

        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }

        // return redirect()->back()->with('success', 'Succesfully import data.');
    }

    public function formImport()
    {
        $this->authorize('import', Taxpayer::class);
        return view('taxpayers.form-import');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file')->store('import');

        $import = new TaxpayerImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }


        // $import = Excel::import(new TaxpayerImport(), $request->file('file'));
        
        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }

        return redirect()->back()->with('success', 'Data berhasil di import.');
    }

    public function create()
    {
        $this->authorize('create', Taxpayer::class);

        // $ar = User::where('position_id', 2)->get();
        $ar = User::whereHas('position', function($query) {
            return $query->where('nama_jabatan', 'Account Representative');
        })->get();

        // $kasi = User::where('position_id', 3)->get();
        $kasi = User::whereHas('position', function($query) {
            return $query->where('nama_jabatan', 'Kepala Seksi');
        })->get();
        return view('taxpayers.create', [
            'ar' => $ar,
            'kasi' => $kasi
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'npwp' => 'required|digits:15|unique:taxpayers,npwp|numeric',
            'nama' => 'required',
            'user_id' => 'required',
            'kasi_id' => 'required'
        ]);

        Taxpayer::create([
            'npwp' => $request->npwp,
            'nama' => $request->nama,
            'user_id' => $request->user_id,
            'kasi_id' => $request->kasi_id,
        ]);

        return redirect()->back()->with('success', 'Data Wajib Pajak Berhasil Ditambahkan.');
    }

    public function edit(Taxpayer $taxpayer)
    {
        $this->authorize('update', $taxpayer);
        // $taxpayer = Taxpayer::find($id);
        // $ar = User::where('position_id', 2)->get();
        // $kasi = User::where('position_id', 1)->get();

        $ar = User::whereHas('position', function($query) {
            return $query->where('nama_jabatan', 'Account Representative');
        })->get();

        $kasi = User::whereHas('position', function($query) {
            return $query->where('nama_jabatan', 'Kepala Seksi');
        })->get();

        return view('taxpayers.edit', [
            'taxpayer' => $taxpayer,
            'ar' => $ar,
            'kasi' => $kasi
        ]);
    }

    public function update(Request $request, Taxpayer $taxpayer)
    {
        $this->validate($request, [
            'npwp' => ['required', 'digits:15', 'numeric', Rule::unique('taxpayers', 'npwp')->ignore($taxpayer->id)],
            'nama' => ['required'],
            'user_id' => ['required'],
            'kasi_id' => ['required']
        ]);

        $taxpayer->update([
            'npwp' => $request->npwp,
            'nama' => $request->nama,
            'user_id' => $request->user_id,
            'kasi_id' => $request->kasi_id,
        ]);

        return redirect()->back()->with('success', 'Data Wajib Pajak Berhasil Diubah.');
    }

    public function destroy(Request $request, Taxpayer $taxpayer)
    {
        $this->authorize('delete', $taxpayer);
        
        $taxpayer_id = $request->taxpayer_id;

        $query = Taxpayer::find($taxpayer_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'message' => 'Data Wajib Pajak berhasil dihapus']);
        } else {
            return response()->json(['code' => 0, 'message' => 'Data Wajib Pajak tidak berhasil dihapus']);
        }
        
        // $taxpayer = Taxpayer::find($id);

        // $taxpayer->delete();

        // return redirect()->back()->with('success', 'Data Wajib Pajak Berhasil Dihapus.');
    }

    public function taxpayerDeleteSelected(Taxpayer $taxpayer, Request $request)
    {
        $this->authorize('delete', $taxpayer);

        $taxpayers_id = $request->taxpayers_id;
        Taxpayer::whereIn('id', $taxpayers_id)->delete();

        return response()->json(['code' => 1, 'message' => 'Data wajib pajak berhasil dihapus dari database.', $taxpayers_id]);
    }
}
