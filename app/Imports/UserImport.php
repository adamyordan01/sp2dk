<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Section;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $position = Position::where('nama_jabatan', $row['nama_jabatan'])->first();
        $section = Section::where('nama_seksi', $row['nama_seksi'])->first();

        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'nip' => $row['nip'],
            'position_id' => $position->id ?? NULL,
            'section_id' => $section->id ?? NULL,
            'password' => Hash::make($row['password'])
        ]);
    }

    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:users,email'],
            '*.nip' => ['numeric', 'unique:users,nip']
        ];
    }
}
