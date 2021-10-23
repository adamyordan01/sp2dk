<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Letter;
use App\Models\Taxpayer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AllLetterImport implements
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

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        // $taxpayer = Taxpayer::where('npwp', $row['npwp'])->where('nama', $row['nama'])->first();
        $taxpayer = Taxpayer::where('npwp', $row['npwp'])->first();

        // $tanggal_kirim_suki = empty($row['tgl_kirim_ke_suki']) ? $row['tgl_kirim_ke_suki'] : Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_kirim_ke_suki']));
        // Yang bawah yang bener
        $tanggal_kirim_suki = empty($row['tgl_kirim_ke_suki']) ? $row['tgl_kirim_ke_suki'] : $this->transformDate($row['tgl_kirim_ke_suki']);

        $tanggal_kirim_pos = empty($row['tgl_kirim_pos']) ? $row['tgl_kirim_pos'] : $this->transformDate($row['tgl_kirim_pos']);

        $tanggal_kempos = empty($row['tgl_kempos']) ? $row['tgl_kempos'] : $this->transformDate($row['tgl_kempos']);

        $tanggal_telpon_wp = empty($row['tgl_telp_wp']) ? $row['tgl_telp_wp'] : $this->transformDate($row['tgl_telp_wp']);

        $tanggal_konseling = empty($row['tgl_konseling']) ? $row['tgl_konseling'] : $this->transformDate($row['tgl_konseling']);

        $tanggal_ba_tidak_hadir = empty($row['tgl_ba_tidak_hadir']) ? $row['tgl_ba_tidak_hadir'] : $this->transformDate($row['tgl_ba_tidak_hadir']);

        $tanggal_visit = empty($row['tgl_visit']) ? $row['tgl_visit'] : $this->transformDate($row['tgl_visit']);

        $tanggal_setor = empty($row['tgl_setor']) ? $row['tgl_setor'] : $this->transformDate($row['tgl_setor']);

        $tanggal_lhp2dk = empty($row['tgl_lhp2dk']) ? $row['tgl_lhp2dk'] : $this->transformDate($row['tgl_lhp2dk']);

        $tanggal_usul_pemeriksaan = empty($row['tgl_usul_pemeriksaan']) ? $row['tgl_usul_pemeriksaan'] : $this->transformDate($row['tgl_usul_pemeriksaan']);

        $tanggal_dspp = empty($row['tgl_dspp']) ? $row['tgl_dspp'] : $this->transformDate($row['tgl_dspp']);

        return new Letter([
            'taxpayer_id' => $taxpayer->id ?? NULL,
            'no_sp2dk' => $row['nomor_sp2dk'],
            'tanggal_sp2dk' => $this->transformDate($row['tanggal_sp2dk']),
            'tahun' => $row['tahun'],
            'potensi_awal' => $row['potensi_awal'],
            'tanggal_kirim_suki' => $tanggal_kirim_suki,
            'tanggal_kirim_pos' => $tanggal_kirim_pos,
            'tanggal_kempos' => $tanggal_kempos,
            'tanggal_telpon_wp' => $tanggal_telpon_wp,
            'hasil_telpon_wp' => $row['hasil_telp_wp'],
            'tanggal_konseling' => $tanggal_konseling,
            'hasil_konseling' => $row['hasil_konseling'],
            'tanggal_ba_tidak_hadir' => $tanggal_ba_tidak_hadir,
            'no_ba_tidak_hadir' => $row['no_ba_tidak_hadir'],
            'tanggal_visit' => $tanggal_visit,
            'hasil_visit' => $row['hasil_visit'],
            'no_lhp2dk' => $row['no_lhp2dk'],
            'tanggal_lhp2dk' => $tanggal_lhp2dk,
            'keputusan' => $row['keputusan'],
            'kesimpulan' => $row['kesimpulan'],
            'potensi_akhir' => $row['potensi_akhir'],
            'realisasi' => $row['realisasi'],
            'tanggal_setor' => $tanggal_setor,
            'tanggal_usul_pemeriksaan' => $tanggal_usul_pemeriksaan,
            'no_dspp' => $row['no_dspp'],
            'tanggal_dspp' => $tanggal_dspp
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nomor_sp2dk' => ['unique:letters,no_sp2dk'],
            '*.no_lhp2dk' => ['unique:letters,no_lhp2dk'],
            '*.no_dspp' => ['unique:letters,no_dspp']
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
}

