<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Taxpayer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

class TaxpayerImport implements 
ToModel,
WithHeadingRow,
SkipsOnError,
WithValidation,
SkipsOnFailure
// WithBatchInserts,
// WithChunkReading,
// ShouldQueue
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $user = User::where('name', $row['nama_ar'])->first();
        $section_chief = User::where('name', $row['kepala_seksi'])->first();
        $section_performer = User::where('name', $row['pelaksana_seksi'])->first();

        return new Taxpayer([
            'npwp' => $row['npwp'],
            'nama' => $row['nama'],
            'user_id' => $user->id ?? NULL,
            'kasi_id' => $section_chief->id ?? NULL,
            'pelaksana_id' => $section_performer->id ?? NULL
        ]);
    }

    public function rules(): array
    {
        return [
            '*.npwp' => ['digits:15', 'unique:taxpayers,npwp']
        ];
    }
    
    // public function batchSize(): int
    // {
    //     return 1000;
    // }

    // public function chunkSize(): int
    // {
    //     return 1000;
    // }

    // public static function afterImport (AfterImport $event)
    // {
        
    // }

    // public function rules(): array
    // {
    //     return [
    //         '*.npwp' => ['digits:15', 'numeric', 'unique:taxpayers,npwp']
    //     ];
    // }

    // public function onFailure(Failure ...$failure)
    // {
        
    // }
}
