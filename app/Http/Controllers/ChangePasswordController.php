<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\throwException;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('change-password.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {
            auth()->user()->update(['password' => bcrypt($request->password)]);
            
            return back()->with('success', 'Password anda berhasil di ubah');
        }

        throw ValidationException::withMessages([
            'current_password' => 'Password anda saat ini tidak cocok.'
        ]);
    }
}
