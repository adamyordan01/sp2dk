<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Taxpayer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\Lhp2dkImport;
use App\Exports\LettersExport;
use App\Imports\LettersImport;
use Illuminate\Validation\Rule;
use App\Exports\LettersExportAr;
use App\Exports\LettersExportKk;
use App\Imports\AllLetterImport;
use App\Imports\SendToPosImport;
use App\Imports\SendToSukiImport;
use App\Imports\BackFromPosImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class LetterController extends Controller
{
    public function index()
    {
        $position = Auth::user()->position->nama_jabatan;

        if (Auth::user()->position->nama_jabatan == "Account Representative") {
            $letters = Auth::user()->letterTaxpayer;

            return view('letters.index', [
                'letters' => $letters
            ]);
        } elseif (Auth::user()->position->nama_jabatan == "Kepala Seksi") {
            $letters = Auth::user()->letterTaxpayerKasi;
            // $letters = Auth::user()->letterTaxpayerKasi()->with(['taxpayer.user'])->get();
            return view('letters.index', [
                'letters' => $letters
            ]);
        } elseif (Auth::user()->position->nama_jabatan == "Pelaksana Seksi") {
            $letters = Auth::user()->letterTaxpayerPelaksana;

            return view('letters.index', [
                'letters' => $letters
            ]);
        } elseif ($position == "Kepala Kantor" || $position == "Operator Console" || $position == "Kepala Suki" || $position == "Pelaksana Suki") {
            $letters = Letter::orderBy('tahun', 'desc')->get();

            return view('letters.index', [
                'letters' => $letters
            ]);
        } elseif ($position == "Kepala Suki" || $position == "Pelaksana Suki") {
            $letters = Letter::orderBy('tahun', 'desc')->get();

            return view('letters.index', [
                'letters' => $letters
            ]);
        }

    }

    public function letterData()
    {
        $position = Auth::user()->position->nama_jabatan;
        if ($position == "Kepala Kantor" || $position == "Operator Console" || $position == "Kepala Suki" || $position == "Pelaksana Suki") {
            $letters = Letter::with(['taxpayer.user.section'])->get();
            // $letters = Letter::orderBy('tahun', 'desc')->get();
            return DataTables::of($letters)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $edit = url('letter/edit/' . $data->id);
                    $delete = url('letter/delete/'.$data->id);
                    $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                    $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

                    return $button;
                })
                ->addColumn('checkbox', function($data){
                    return '<input type="checkbox" name="letter_checkbox" data-id="'.$data->id.'">';
                })
                ->editColumn('tanggal_sp2dk', function ($letter) {
                    return $letter->tanggal_sp2dk->format('Y/m/d');
                })
                ->editColumn('tahun_sp2dk', function ($letter) {
                    return $letter->tanggal_sp2dk->format('Y');
                })
                ->editColumn('tanggal_kirim_suki', function ($letter) {
                    return $letter->tanggal_kirim_suki ? $letter->tanggal_kirim_suki->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_kirim_pos', function ($letter) {
                    return $letter->tanggal_kirim_pos ? $letter->tanggal_kirim_pos->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_kempos', function ($letter) {
                    return $letter->tanggal_kempos ? $letter->tanggal_kempos->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_telpon_wp', function ($letter) {
                    return $letter->tanggal_telpon_wp ? $letter->tanggal_telpon_wp->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_konseling', function ($letter) {
                    return $letter->tanggal_konseling ? $letter->tanggal_konseling->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_ba_tidak_hadir', function ($letter) {
                    return $letter->tanggal_ba_tidak_hadir ? $letter->tanggal_ba_tidak_hadir->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_visit', function ($letter) {
                    return $letter->tanggal_visit ? $letter->tanggal_visit->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_lhp2dk', function ($letter) {
                    return $letter->tanggal_lhp2dk ? $letter->tanggal_lhp2dk->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_setor', function ($letter) {
                    return $letter->tanggal_setor ? $letter->tanggal_setor->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_usul_pemeriksaan', function ($letter) {
                    return $letter->tanggal_usul_pemeriksaan ? $letter->tanggal_usul_pemeriksaan->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_dspp', function ($letter) {
                    return $letter->tanggal_dspp ? $letter->tanggal_dspp->format('Y/m/d') : '';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        } elseif (Auth::user()->position->nama_jabatan == "Kepala Seksi") {
            $letters = Auth::user()->letterTaxpayerKasi()->with(['taxpayer.user.section'])->get();
            return DataTables::of($letters)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $edit = url('letter/edit/' . $data->id);
                    $delete = url('letter/delete/'.$data->id);
                    $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                    $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

                    return $button;
                })
                ->addColumn('checkbox', function($data){
                    return '<input type="checkbox" name="letter_checkbox" data-id="'.$data->id.'">';
                })
                ->editColumn('tanggal_sp2dk', function ($letter) {
                    return $letter->tanggal_sp2dk->format('Y/m/d');
                })
                ->editColumn('tahun_sp2dk', function ($letter) {
                    return $letter->tanggal_sp2dk->format('Y');
                })
                ->editColumn('tanggal_kirim_suki', function ($letter) {
                    return $letter->tanggal_kirim_suki ? $letter->tanggal_kirim_suki->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_kirim_pos', function ($letter) {
                    return $letter->tanggal_kirim_pos ? $letter->tanggal_kirim_pos->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_kempos', function ($letter) {
                    return $letter->tanggal_kempos ? $letter->tanggal_kempos->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_telpon_wp', function ($letter) {
                    return $letter->tanggal_telpon_wp ? $letter->tanggal_telpon_wp->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_konseling', function ($letter) {
                    return $letter->tanggal_konseling ? $letter->tanggal_konseling->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_ba_tidak_hadir', function ($letter) {
                    return $letter->tanggal_ba_tidak_hadir ? $letter->tanggal_ba_tidak_hadir->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_visit', function ($letter) {
                    return $letter->tanggal_visit ? $letter->tanggal_visit->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_lhp2dk', function ($letter) {
                    return $letter->tanggal_lhp2dk ? $letter->tanggal_lhp2dk->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_setor', function ($letter) {
                    return $letter->tanggal_setor ? $letter->tanggal_setor->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_usul_pemeriksaan', function ($letter) {
                    return $letter->tanggal_usul_pemeriksaan ? $letter->tanggal_usul_pemeriksaan->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_dspp', function ($letter) {
                    return $letter->tanggal_dspp ? $letter->tanggal_dspp->format('Y/m/d') : '';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        } elseif (Auth::user()->position->nama_jabatan == "Account Representative") {
            $letters = Auth::user()->letterTaxpayer()->with(['taxpayer.user.section'])->get();
            return DataTables::of($letters)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $edit = url('letter/edit/' . $data->id);
                    $delete = url('letter/delete/'.$data->id);
                    $button = '<a href="'.$edit.'" class="btn btn-primary">Edit</a>';
                    $button .= '<button class="btn btn-danger" data-id="'. $data->id .'" id="deleteButton">Hapus</button>';

                    return $button;
                })
                ->addColumn('checkbox', function($data){
                    return '<input type="checkbox" name="letter_checkbox" data-id="'.$data->id.'">';
                })
                ->editColumn('tanggal_sp2dk', function ($letter) {
                    return $letter->tanggal_sp2dk->format('Y/m/d');
                })
                ->editColumn('tahun_sp2dk', function ($letter) {
                    return $letter->tanggal_sp2dk->format('Y');
                })
                ->editColumn('tanggal_kirim_suki', function ($letter) {
                    return $letter->tanggal_kirim_suki ? $letter->tanggal_kirim_suki->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_kirim_pos', function ($letter) {
                    return $letter->tanggal_kirim_pos ? $letter->tanggal_kirim_pos->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_kempos', function ($letter) {
                    return $letter->tanggal_kempos ? $letter->tanggal_kempos->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_telpon_wp', function ($letter) {
                    return $letter->tanggal_telpon_wp ? $letter->tanggal_telpon_wp->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_konseling', function ($letter) {
                    return $letter->tanggal_konseling ? $letter->tanggal_konseling->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_ba_tidak_hadir', function ($letter) {
                    return $letter->tanggal_ba_tidak_hadir ? $letter->tanggal_ba_tidak_hadir->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_visit', function ($letter) {
                    return $letter->tanggal_visit ? $letter->tanggal_visit->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_lhp2dk', function ($letter) {
                    return $letter->tanggal_lhp2dk ? $letter->tanggal_lhp2dk->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_setor', function ($letter) {
                    return $letter->tanggal_setor ? $letter->tanggal_setor->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_usul_pemeriksaan', function ($letter) {
                    return $letter->tanggal_usul_pemeriksaan ? $letter->tanggal_usul_pemeriksaan->format('Y/m/d') : '';
                })
                ->editColumn('tanggal_dspp', function ($letter) {
                    return $letter->tanggal_dspp ? $letter->tanggal_dspp->format('Y/m/d') : '';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
    }

    public function formImport()
    {
        $this->authorize('import', Letter::class);
        
        return view('letters.form-import');
    }

    public function importAllLetter(Request $request)
    {
        $this->validate($request, [
            'all-letter' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('all-letter')->store('import');

        $import = new AllLetterImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->back()->with('success', 'Berhasil import seluruh data sp2dk.');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file')->store('import');

        $import = new LettersImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->back()->with('success', 'Berhasil import data sp2dk.');
    }

    // public function formSendToSuki()
    // {
    //     $this->authorize('import', Letter::class);

    //     return view('letters.form-send-to-suki');
    // }

    public function sendToPos(Request $request)
    {
        $this->validate($request, [
            'send-to-pos' => 'mimes:xlsx,xls'
        ]);

        Excel::import(new SendToPosImport, $request->file('send-to-pos'));

        // $file = $request->file('send_to_suki')->store('import');

        // $import = new SendToSukiImport;
        // $import->import($file);

        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }

        return redirect()->back()->with('success', 'Berhasil import data kirim pos.');
    }

    public function sendToSuki(Request $request)
    {
        $this->validate($request, [
            'send-to-suki' => 'mimes:xlsx,xls'
        ]);

        Excel::import(new SendToSukiImport, $request->file('send-to-suki'));

        // $file = $request->file('send_to_suki')->store('import');

        // $import = new SendToSukiImport;
        // $import->import($file);

        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }

        return redirect()->back()->with('success', 'Berhasil import data Kirim ke Suki.');
    }

    public function backFromPos(Request $request)
    {
        $this->validate($request, [
            'back-from-pos' => 'mimes:xlsx,xls'
        ]);

        Excel::import(new BackFromPosImport, $request->file('back-from-pos'));

        return redirect()->back()->with('success', 'Berhasil import data kempos.');
    }

    public function importLhp2dk(Request $request)
    {
        $this->validate($request, [
            'import-lhp2dk' => 'mimes:xlsx,xls'
        ]);

        Excel::import(new Lhp2dkImport, $request->file('import-lhp2dk'));

        return redirect()->back()->with('success', 'Berhasil import data lhp2dk.');
    }

    public function create()
    {
        $this->authorize('create', Letter::class);
        // $ar = User::where('position_id', 2)->get();
        // $kasi = User::where('position_id', 1)->get();
        $kasi = Auth::user()->position->nama_jabatan == "Kepala Seksi";
        $pelaksana = Auth::user()->position->nama_jabatan == "Pelaksana Seksi";
        $ar = Auth::user()->position->nama_jabatan == "Account Representative";
        if ($kasi) {
            $taxpayers = Taxpayer::where('kasi_id', Auth::id())->get();
            return view('letters.create', [
                'taxpayers' => $taxpayers,
            ]);
        } elseif ($pelaksana) {
            $taxpayers = Taxpayer::where('pelaksana_id', Auth::id())->get();
            return view('letters.create', [
                'taxpayers' => $taxpayers,
            ]);
        } elseif ($ar) {
            $taxpayers = Taxpayer::where('user_id', Auth::id())->get();
            return view('letters.create', [
                'taxpayers' => $taxpayers,
            ]);
        }
        // $taxpayers = Taxpayer::all();
        // return view('letters.create', [
        //     'taxpayers' => $taxpayers,
        // ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'taxpayer_id' => 'required',
            'no_sp2dk' => 'required|unique:letters,no_sp2dk',
            'tanggal_sp2dk' => 'required',
            'tahun' => 'required|digits:4',
            'potensi_awal' => '',
            'tanggal_kirim_suki' => '',
            'tanggal_kirim_pos' => '',
            'tanggal_kempos' => '',
            'tanggal_telpon_wp' => '',
            'hasil_telpon_wp' => '',
            'tanggal_konseling' => '',
            'hasil_konseling' => '',
            'tanggal_ba_tidak_hadir' => '',
            'no_ba_tidak_hadir' => '',
            'tanggal_visit' => '',
            'hasil_visit' => '',
            'no_lhp2dk' => '',
            // 'no_lhp2dk' => 'unique:letters,no_lhp2dk',
            'tanggal_lhp2dk' => '',
            'keputusan' => '',
            'kesimpulan' => '',
            'potensi_akhir' => '',
            'realisasi' => '',
            'tanggal_setor' => '',
            'tanggal_usul_pemeriksaan' => '',
            'no_dspp' => '',
            // 'no_dspp' => 'unique:letters,no_dspp',
            'tanggal_dspp' => '',
        ]);

        Letter::create([
            'taxpayer_id' => $request->taxpayer_id,
            'no_sp2dk' => $request->no_sp2dk,
            'tanggal_sp2dk' => $request->tanggal_sp2dk,
            'tahun' => $request->tahun,
            'potensi_awal' => $request->potensi_awal ? Str::replaceArray('.', [''], $request->potensi_awal) : null,
            'tanggal_kirim_suki' => $request->tanggal_kirim_suki,
            'tanggal_kirim_pos' => $request->tanggal_kirim_pos,
            'tanggal_kempos' => $request->tanggal_kempos,
            'tanggal_telpon_wp' => $request->tanggal_telpon_wp,
            'hasil_telpon_wp' => $request->hasil_telpon_wp,
            'tanggal_konseling' => $request->tanggal_konseling,
            'hasil_konseling' => $request->hasil_konseling,
            'tanggal_ba_tidak_hadir' => $request->tanggal_ba_tidak_hadir,
            'no_ba_tidak_hadir' => $request->no_ba_tidak_hadir,
            'tanggal_visit' => $request->tanggal_visit,
            'hasil_visit' => $request->hasil_visit,
            'no_lhp2dk' => $request->no_lhp2dk,
            'tanggal_lhp2dk' => $request->tanggal_lhp2dk,
            'keputusan' => $request->keputusan,
            'kesimpulan' => $request->kesimpulan,
            'potensi_akhir' => $request->potensi_akhir ? Str::replaceArray('.', [''], $request->potensi_akhir) : null,
            'realisasi' => $request->realisasi ? Str::replaceArray('.', [''], $request->realisasi) : null,
            'tanggal_setor' => $request->tanggal_setor,
            'tanggal_usul_pemeriksaan' => $request->tanggal_usul_pemeriksaan,
            'no_dspp' => $request->no_dspp,
            'tanggal_dspp' => $request->tanggal_dspp,
        ]);

        return redirect()->back()->with('success', 'Data Surat Berhasil Ditambahkan.');
    }

    public function edit(Letter $letter)
    {
        $this->authorize('update', $letter);

        // $letter = Letter::find($id);
        $taxpayers = Taxpayer::all();

        return view('letters.edit', [
            'letter' => $letter,
            'taxpayers' => $taxpayers,
        ]);
    }

    public function show(Letter $letter)
    {
        if (Auth::user()->position->nama_jabatan == "Kepala Kantor") {
            return view('letters.show', [
                'letter' => $letter
            ]);
        } elseif (Auth::user()->position->nama_jabatan == "Kepala Suki") {
            return view('letters.show', [
                'letter' => $letter
            ]);
        } elseif (Auth::user()->position->nama_jabatan == "Pelaksana Suki") {
            return view('letters.show', [
                'letter' => $letter
            ]);
        }
        $this->authorize('view', $letter);
        // $letter = Letter::find($id);
        
        return view('letters.show', [
            'letter' => $letter
        ]);
    }

    public function update(Request $request, Letter $letter)
    {
        $position = Auth::user()->position->nama_jabatan;

        if ($position == "Kepala Suki" || $position == "Pelaksana Suki") {
            $letter->update([
                'tanggal_kirim_suki' => $request->tanggal_kirim_suki,
                'tanggal_kirim_pos' => $request->tanggal_kirim_pos,
                'tanggal_kempos' => $request->tanggal_kempos,
            ]);
            return redirect()->back()->with('success', 'Data Surat Berhasil Diubah.');

        } elseif ($position == "Kepala Seksi" || $position == "Account Representative") {
            $this->validate($request, [
                // 'npwp' => ['required', 'digits:15', 'numeric', Rule::unique('taxpayers', 'npwp')->ignore($taxpayer->id)],
                // 'nama' => ['required'],
                // 'user_id' => ['required'],
                // 'kasi_id' => ['required']
                'taxpayer_id' => 'required',
                'no_sp2dk' => ['required', Rule::unique('letters', 'no_sp2dk')->ignore($letter->id)],
                'tanggal_sp2dk' => 'required',
                'tahun' => 'required|digits:4',
                'potensi_awal' => '',
                'tanggal_kirim_suki' => '',
                'tanggal_kirim_pos' => '',
                'tanggal_kempos' => '',
                'tanggal_telpon_wp' => '',
                'hasil_telpon_wp' => '',
                'tanggal_konseling' => '',
                'hasil_konseling' => '',
                'tanggal_ba_tidak_hadir' => '',
                'no_ba_tidak_hadir' => '',
                'tanggal_visit' => '',
                'hasil_visit' => '',
                'no_lhp2dk' => '',
                // 'no_lhp2dk' => ['required', Rule::unique('letters', 'no_lhp2dk')->ignore($letter->id)],
                'tanggal_lhp2dk' => '',
                'keputusan' => '',
                'kesimpulan' => '',
                'potensi_akhir' => '',
                'realisasi' => '',
                'tanggal_setor' => '',
                'tanggal_usul_pemeriksaan' => '',
                'no_dspp' => '',
                // 'no_dspp' => ['required', Rule::unique('letters', 'no_dspp')->ignore($letter->id)],
                'tanggal_dspp' => '',
            ]);
    
            $letter->update([
                // 'npwp' => $request->npwp,
                // 'nama' => $request->nama,
                // 'user_id' => $request->user_id,
                // 'kasi_id' => $request->kasi_id,
                'taxpayer_id' => $request->taxpayer_id,
                'no_sp2dk' => $request->no_sp2dk,
                'tanggal_sp2dk' => $request->tanggal_sp2dk,
                'tahun' => $request->tahun,
                'potensi_awal' => $request->potensi_awal ? Str::replaceArray('.', [''], $request->potensi_awal) : null,
                'tanggal_kirim_suki' => $request->tanggal_kirim_suki,
                'tanggal_kirim_pos' => $request->tanggal_kirim_pos,
                'tanggal_kempos' => $request->tanggal_kempos,
                'tanggal_telpon_wp' => $request->tanggal_telpon_wp,
                'hasil_telpon_wp' => $request->hasil_telpon_wp,
                'tanggal_konseling' => $request->tanggal_konseling,
                'hasil_konseling' => $request->hasil_konseling,
                'tanggal_ba_tidak_hadir' => $request->tanggal_ba_tidak_hadir,
                'no_ba_tidak_hadir' => $request->no_ba_tidak_hadir,
                'tanggal_visit' => $request->tanggal_visit,
                'hasil_visit' => $request->hasil_visit,
                'no_lhp2dk' => $request->no_lhp2dk,
                'tanggal_lhp2dk' => $request->tanggal_lhp2dk,
                'keputusan' => $request->keputusan,
                'kesimpulan' => $request->kesimpulan,
                'potensi_akhir' => $request->potensi_akhir ? Str::replaceArray('.', [''], $request->potensi_akhir) : null,
                'realisasi' => $request->realisasi ? Str::replaceArray('.', [''], $request->realisasi) : null,
                'tanggal_setor' => $request->tanggal_setor,
                'tanggal_usul_pemeriksaan' => $request->tanggal_usul_pemeriksaan,
                'no_dspp' => $request->no_dspp,
                'tanggal_dspp' => $request->tanggal_dspp,
            ]);
            return redirect()->back()->with('success', 'Data Surat Berhasil Diubah.');
            
        } elseif ($position == "Pelaksana Seksi") {
            $letter->update([
                // 'npwp' => $request->npwp,
                // 'nama' => $request->nama,
                // 'user_id' => $request->user_id,
                // 'kasi_id' => $request->kasi_id,
                'taxpayer_id' => $request->taxpayer_id,
                'no_sp2dk' => $request->no_sp2dk,
                'tanggal_sp2dk' => $request->tanggal_sp2dk,
                'tahun' => $request->tahun,
                'potensi_awal' => Str::replaceArray('.', [''], $request->potensi_awal),
                'tanggal_kirim_suki' => $request->tanggal_kirim_suki,
                'tanggal_kirim_pos' => $request->tanggal_kirim_pos,
                'tanggal_kempos' => $request->tanggal_kempos,
                'no_lhp2dk' => $request->no_lhp2dk,
                'tanggal_lhp2dk' => $request->tanggal_lhp2dk,
                'keputusan' => $request->keputusan,
                'kesimpulan' => $request->kesimpulan,
                'potensi_akhir' => Str::replaceArray('.', [''], $request->potensi_akhir),
                'realisasi' => Str::replaceArray('.', [''], $request->realisasi),
            ]);
            return redirect()->back()->with('success', 'Data Surat Berhasil Diubah.');
        }
    }

    public function export()
    {
        return Excel::download(new LettersExport, 'sp2dk-"'.date(now()).'".xlsx');
    }

    public function exportAr()
    {
        return Excel::download(new LettersExportAr, 'sp2dk-"'.date(now()).'".xlsx');
    }

    public function exportKk()
    {
        return Excel::download(new LettersExportKk, 'sp2dk-"'.date(now()).'".xlsx');
    }

    public function destroy(Request $request, Letter $letter)
    {
        // $letter = Letter::find($id);
        $this->authorize('delete', $letter);

        $letter_id = $request->letter_id;

        $query = Letter::find($letter_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'message' => 'Data sp2dk berhasil dihapus']);
        } else {
            return response()->json(['code' => 0, 'message' => 'Data sp2dk tidak berhasil dihapus']);
        }

        // $letter->delete();

        // return redirect()->back()->with('success', 'Data Surat Berhasil Dihapus.');
    }

    public function letterDeleteSelected(Letter $letter, Request $request)
    {
        $this->authorize('delete', $letter);

        $letters_id = $request->letters_id;
        Letter::whereIn('id', $letters_id)->delete();

        return response()->json(['code' => 1, 'message' => 'Data sp2dk berhasil dihapus dari database.', $letters_id]);
    }
}
