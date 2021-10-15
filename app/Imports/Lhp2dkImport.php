<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Letter;
use App\Models\Taxpayer;
use Dotenv\Parser\Lexer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class Lhp2dkImport implements ToCollection, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsErrors, SkipsFailures;

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function collection(Collection $rows)
    {
        // $tanggal_kirim_suki = empty($row['tgl_kirim_ke_suki']) ? $row['tgl_kirim_ke_suki'] : $this->transformDate($row['tgl_kirim_ke_suki']);

        foreach ($rows as $row) {
            $letter = Letter::where('no_sp2dk', $row['nomor_sp2dk'])->first();

            $letter->no_lhp2dk = $row['no_lhp2dk'];
            $letter->tanggal_lhp2dk = empty($row['tgl_lhp2dk']) ? $row['tgl_lhp2dk'] : $this->transformDate($row['tgl_lhp2dk']);
            $letter->keputusan = $row['keputusan'];
            $letter->kesimpulan = $row['kesimpulan'];
            $letter->potensi_akhir = $row['potensi_akhir'];
            $letter->realisasi = $row['realisasi'];

            $letter->save();
        }
    }

    public function rules(): array
    {
        return [
            '*.nomor_sp2dk' => ['unique:letters,no_sp2dk'],
            '*.no_lhp2dk' => ['unique:letters,no_lhp2dk'],
            // '*.no_dspp' => ['unique:letters,no_dspp']
        ];
    }
}
