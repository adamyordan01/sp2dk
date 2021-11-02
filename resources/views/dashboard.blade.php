@extends('layouts.base', ['title' => 'MoSART - Dashboard'])

@section('section-header')
    <h1>Dashboard</h1>
@endsection

@push('style')
    <style>
        .card-body {
            font-size: 15px !important;
        }
    </style>
@endpush

@section('content')
    @if (Auth::user()->position->nama_jabatan == "Kepala Kantor" || Auth::user()->position->nama_jabatan == "Kepala Seksi" || Auth::user()->position->nama_jabatan == "Account Representative" || Auth::user()->position->nama_jabatan == "Kepala Seksi Penjamin Kualitas Data")
        <div class="row">
            <div class="col-md-12">
                <div class="form-row mb-5">
                    <form action="">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="">Filter Tahun Pembuatan SP2DK</label>
                            </div>
                            <div class="col-auto">
                                <select name="year" class="form-control" id="">
                                    <option value="" {{ request()->year == '' ? 'selected' : '' }}>all</option>
                                    @foreach ($filters as $filter)
                                        <option value="{{ $filter->year }}" {{ request()->year == $filter->year ? 'selected' : '' }}>{{ $filter->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <form action="" class="ml-4">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="">Filter Tahun Pembuatan LHP2DK</label>
                            </div>
                            <div class="col-auto">
                                <select name="lhp2dk" class="form-control" id="">
                                    <option value="" {{ request()->lhp2dk == '' ? 'selected' : '' }}>all</option>
                                    @foreach ($filtersLhp2dk as $filterLhp2dk)
                                        <option value="{{ $filterLhp2dk->lhp2dk }}" {{ request()->lhp2dk == $filterLhp2dk->lhp2dk ? 'selected' : '' }}>{{ $filterLhp2dk->lhp2dk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif    

    @if ( Auth::user()->position->nama_jabatan == "Account Representative")
        <div class="row">
            @foreach ($letters as $letter)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-mail-bulk"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah SP2DK</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_sp2dk }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Potensi Awal</h4>
                            </div>
                            <div class="card-body">
                                {{-- Rp. {{ number_format($letters_potensi_awal->sum(),0,',','.') }} --}}
                                Rp. {{ number_format($letter->total_potensi_awal, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SP2DK dikirim ke Pos</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_sp2dk_kirim_pos }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SP2DK KemPos</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_kempos }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah WP yang di telpon</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_telpon_wp }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah WP Konseling</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_konseling }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah BA tidak Hadir</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_ba_tidak_hadir }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shuttle-van"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Visit</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_visit }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah LHP2DK</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_lhp2dk }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Potensi Akhir</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($letter->total_potensi_akhir,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Realisasi</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($letter->total_realisasi,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-th-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah DSPP</h4>
                            </div>
                            <div class="card-body">
                                {{ $letter->total_dspp }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if (Auth::user()->position->nama_jabatan == "Kepala Kantor" || Auth::user()->position->nama_jabatan == "Kepala Seksi Penjamin Kualitas Data")
        <div class="row">
            @foreach ($lettersKk as $letterKk)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-mail-bulk"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah SP2DK</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_sp2dk }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Potensi Awal</h4>
                            </div>
                            <div class="card-body">
                                {{-- Rp. {{ number_format($letters_potensi_awal->sum(),0,',','.') }} --}}
                                Rp. {{ number_format($letterKk->total_potensi_awal, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SP2DK dikirim ke Pos</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_sp2dk_kirim_pos }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SP2DK KemPos</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_kempos }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah WP yang di telpon</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_telpon_wp }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah WP Konseling</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_konseling }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah BA tidak Hadir</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_ba_tidak_hadir }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shuttle-van"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Visit</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_visit }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah LHP2DK</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_lhp2dk }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Potensi Akhir</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($letterKk->total_potensi_akhir,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Realisasi</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($letterKk->total_realisasi,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-th-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah DSPP</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKk->total_dspp }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if (Auth::user()->position->nama_jabatan == "Kepala Seksi")
        <div class="row">
            @foreach ($lettersKasi as $letterKasi)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-mail-bulk"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah SP2DK</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_sp2dk }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Potensi Awal</h4>
                            </div>
                            <div class="card-body">
                                {{-- Rp. {{ number_format($letters_potensi_awal->sum(),0,',','.') }} --}}
                                Rp. {{ number_format($letterKasi->total_potensi_awal, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SP2DK dikirim ke Pos</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_sp2dk_kirim_pos }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SP2DK KemPos</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_kempos }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah WP yang di telpon</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_telpon_wp }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah WP Konseling</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_konseling }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah BA tidak Hadir</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_ba_tidak_hadir }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shuttle-van"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Visit</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_visit }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah LHP2DK</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_lhp2dk }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Potensi Akhir</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($letterKasi->total_potensi_akhir,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Realisasi</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($letterKasi->total_realisasi,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-th-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah DSPP</h4>
                            </div>
                            <div class="card-body">
                                {{ $letterKasi->total_dspp }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @foreach ($letters as $letter)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Account Representative -  {{ $letter->AR }}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jumlah SP2DK</th>
                                            <th>Jumlah Potensi Awal</th>
                                            <th>SP2DK dikirim ke Pos</th>
                                            <th>SP2DK KemPos</th>
                                            <th>Jumlah WP Yang DiTelepon</th>
                                            <th>Jumlah WP Konseling</th>
                                            <th>Jumlah BA Tidak Hadir</th>
                                            <th>Jumlah Visit</th>
                                            <th>Jumlah LHP2DK</th>
                                            <th>Jumlah Potensi Akhir</th>
                                            <th>Jumlah Realisasi</th>
                                            <th>Jumlah DSPP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $letter->total_sp2dk }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letter->total_potensi_awal,0,',','.') }}
                                            </td>
                                            <td>
                                                {{ $letter->total_sp2dk_kirim_pos }}
                                            </td>
                                            <td>
                                                {{ $letter->total_kempos }}
                                            </td>
                                            <td>
                                                {{ $letter->total_telpon_wp }}
                                            </td>
                                            <td>
                                                {{ $letter->total_konseling }}
                                            </td>
                                            <td>
                                                {{ $letter->total_ba_tidak_hadir }}
                                            </td>
                                            <td>
                                                {{ $letter->total_visit }}
                                            </td>
                                            <td>
                                                {{ $letter->total_lhp2dk }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letter->total_potensi_akhir,0,',','.') }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letter->total_realisasi,0,',','.') }}
                                            </td>
                                            <td>
                                                {{ $letter->total_dspp }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if (Auth::user()->position->nama_jabatan == "Kepala Kantor" || Auth::user()->position->nama_jabatan == "Kepala Seksi Penjamin Kualitas Data")
        @foreach ($lettersKasi as $letterKasi)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Kepala Seksi -  {{ $letterKasi->AR . " - " . $letterKasi->nama_seksi }}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jumlah SP2DK</th>
                                            <th>Jumlah Potensi Awal</th>
                                            <th>SP2DK dikirim ke Pos</th>
                                            <th>SP2DK KemPos</th>
                                            <th>Jumlah WP Yang DiTelepon</th>
                                            <th>Jumlah WP Konseling</th>
                                            <th>Jumlah BA Tidak Hadir</th>
                                            <th>Jumlah Visit</th>
                                            <th>Jumlah LHP2DK</th>
                                            <th>Jumlah Potensi Akhir</th>
                                            <th>Jumlah Realisasi</th>
                                            <th>Jumlah DSPP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $letterKasi->total_sp2dk }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letterKasi->total_potensi_awal,0,',','.') }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_sp2dk_kirim_pos }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_kempos }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_telpon_wp }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_konseling }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_ba_tidak_hadir }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_visit }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_lhp2dk }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letterKasi->total_potensi_akhir,0,',','.') }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letterKasi->total_realisasi,0,',','.') }}
                                            </td>
                                            <td>
                                                {{ $letterKasi->total_dspp }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if (Auth::user()->position->nama_jabatan == "Kepala Kantor" || Auth::user()->position->nama_jabatan == "Kepala Seksi Penjamin Kualitas Data")
        @foreach ($letters as $letter)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Account Representative -  {{ $letter->AR . " - " . $letter->nama_seksi }}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jumlah SP2DK</th>
                                            <th>Jumlah Potensi Awal</th>
                                            <th>SP2DK dikirim ke Pos</th>
                                            <th>SP2DK KemPos</th>
                                            <th>Jumlah WP Yang DiTelepon</th>
                                            <th>Jumlah WP Konseling</th>
                                            <th>Jumlah BA Tidak Hadir</th>
                                            <th>Jumlah Visit</th>
                                            <th>Jumlah LHP2DK</th>
                                            <th>Jumlah Potensi Akhir</th>
                                            <th>Jumlah Realisasi</th>
                                            <th>Jumlah DSPP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $letter->total_sp2dk }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letter->total_potensi_awal,0,',','.') }}
                                            </td>
                                            <td>
                                                {{ $letter->total_sp2dk_kirim_pos }}
                                            </td>
                                            <td>
                                                {{ $letter->total_kempos }}
                                            </td>
                                            <td>
                                                {{ $letter->total_telpon_wp }}
                                            </td>
                                            <td>
                                                {{ $letter->total_konseling }}
                                            </td>
                                            <td>
                                                {{ $letter->total_ba_tidak_hadir }}
                                            </td>
                                            <td>
                                                {{ $letter->total_visit }}
                                            </td>
                                            <td>
                                                {{ $letter->total_lhp2dk }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letter->total_potensi_akhir,0,',','.') }}
                                            </td>
                                            <td>
                                                Rp. {{ number_format($letter->total_realisasi,0,',','.') }}
                                            </td>
                                            <td>
                                                {{ $letter->total_dspp }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if (Auth::user()->position->nama_jabatan == "Kepala Subbag" || Auth::user()->position->nama_jabatan == "Pelaksana Suki" || Auth::user()->position->nama_jabatan == "Pelaksana Seksi" || Auth::user()->position->nama_jabatan == "Operator Console" || Auth::user()->position->nama_jabatan == "Kepala Seksi Penjamin Kualitas Data")

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Hallo, {{ Auth::user()->name }} selamat datang didalam sistem SP2DK.
                    </div>
                </div>
            </div>
        </div>
        
    @endif

@endsection