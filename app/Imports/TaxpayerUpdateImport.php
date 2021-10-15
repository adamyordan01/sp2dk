<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Taxpayer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TaxpayerUpdateImport implements ToCollection, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $taxpayer = Taxpayer::where('npwp', $row['npwp'])->first();
            $user = User::where('name', $row['nama_ar'])->first();
            $section_chief = User::where('name', $row['kepala_seksi'])->first();
            $section_performer = User::where('name', $row['pelaksana_seksi'])->first();

            $taxpayer->nama = $row['nama'];
            $taxpayer->user_id = $user->id ?? NULL;
            $taxpayer->kasi_id = $section_chief->id ?? NULL;
            $taxpayer->pelaksana_id = $section_performer->id ?? NULL;

            $taxpayer->save();
        }
    }

    public function rules(): array
    {
        return [
            '*.npwp' => ['digits:15', 'unique:taxpayers,npwp']
        ];
    }
}
