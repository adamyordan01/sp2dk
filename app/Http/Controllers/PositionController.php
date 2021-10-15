<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Position::class);

        // $positions = Position::paginate(10);
        return view('positions.index');
        // return view('positions.index', [
        //     'positions' => $positions
        // ]);
    }

    public function getPosition()
    {
        $positions = Position::select(['id', 'nama_jabatan']);

        return DataTables::of($positions)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $edit = url('position/'. $data->id .'/edit');
            $delete = url('position/'. $data->id .'/delete');
            $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
            $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function create()
    {
        $this->authorize('create', Position::class);

        return view('positions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required'
        ]);

        Position::create([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return redirect()->back()->with('success', 'Data jabatan berhasil ditambah.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('edit', Position::class);

        $position = Position::find($id);

        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required'
        ]);

        $position = Position::find($id);

        $position->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return redirect()->back()->with('success', 'Data jabatan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $position_id = $request->position_id;

        $query = Position::find($position_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'message' => 'Data jabatan berhasil dihapus']);
        } else {
            return response()->json(['code' => 0, 'message' => 'Data jabatan tidak berhasil dihapus']);
        }

        // $position = Position::find($id);

        // $position->delete();

        // return redirect()->back()->with('success', 'Data jabatan berhasil dihapus.');
    }
}
