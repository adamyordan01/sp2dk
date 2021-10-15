<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Section;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $sections = Section::all();
        $positions = Position::where('nama_jabatan', '!=', 'Kepala Kantor')->Where('nama_jabatan', '!=', 'Kepala Suki')->get();

        return view('user-informations.edit', [
            'sections' => $sections,
            'positions' => $positions
        ]);
    }

    public function update(Request $request)
    {
        
    }
}
