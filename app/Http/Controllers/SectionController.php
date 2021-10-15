<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Position::class);
        
        // $sections = Section::all();

        return view('sections.index');
    }

    public function getSection()
    {
        $sections = Section::select(['id', 'nama_seksi']);
        return DataTables::of($sections)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $edit = url('section/'. $data->id .'/edit');
            // $delete = url('section/'. $data->id .'/delete');
            $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
            $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function create()
    {
        $this->authorize('create', Section::class);

        return view('sections.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_seksi' => 'required'
        ]);

        Section::create([
            'nama_seksi' => $request->nama_seksi
        ]);

        return redirect()->back()->with('success', 'Data seksi berhasil ditambah.');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit', Section::class);

        $section = Section::find($id);

        return view('sections.edit', [
            'section' => $section
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $section = Section::find($id);

        $this-> validate($request, [
            'nama_seksi' => 'required'
        ]);

        $section->update([
            'nama_seksi' => $request->nama_seksi
        ]);

        return redirect()->back()->with('success', 'Data seksi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $section_id = $request->section_id;

        $query = Section::find($section_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'message' => 'Data seksi berhasil dihapus']);
        } else {
            return response()->json(['code' => 0, 'message' => 'Data seksi tidak berhasil dihapus']);
        }

        // $section = Section::find($id);

        // $section->delete();

        // return redirect()->back()->with('success', 'Data seksi berhasil dihapus.');
    }
}
