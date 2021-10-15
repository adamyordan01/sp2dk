@extends('layouts.mazer', ['title' => 'Detail Data SP2DK'])

@push('style')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/datepicker/bootstrap-datepicker.min.css" />
@endpush

@section('content')
<div class="col-12 col-lg-8">
    <div class="card">
        <div class="card-header mb-3">
            <div class="row jusify-content-between align-items-center">
                <div class="col-md">
                    <a href="{{ route('letter.index') }}">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-md">Detail Data SP2DK</div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <label>Nomor Pokok Wajib Pajak</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->taxpayer->npwp }}</p>
                </div>
                <div class="col-md-5">
                    <label>Nama Wajib Pajak</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->taxpayer->nama }}</p>
                </div>
                <div class="col-md-5">
                    <label>Account Representative (AR)</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->taxpayer->user->name }}</p>
                </div>
                <div class="col-md-5">
                    <label>Nomor SP2DK</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->no_sp2dk }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal SP2DK</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_sp2dk ? $letter->tanggal_sp2dk->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tahun</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tahun ? $letter->tahun : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Potensi Awal</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">Rp. {{ $letter->potensi_awal ? number_format($letter->potensi_awal) : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Kirim SUKI</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_kirim_suki ? $letter->tanggal_kirim_suki->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Kirim POS</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_kirim_pos ? $letter->tanggal_kirim_pos->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Kembali POS</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_kempos ? $letter->tanggal_kempos->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Telp WP</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_telpon_wp ? $letter->tanggal_telpon_wp->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Hasil Telp WP</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->hasil_telpon_wp ? $letter->hasil_telpon_wp : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Konseling</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_konseling ? $letter->tanggal_konseling->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Hasil Konseling</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->hasil_konseling ? $letter->hasil_konseling : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal BA Tidak Hadir</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_ba_tidak_hadir ? $letter->tanggal_ba_tidak_hadir->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Nomor BA Tidak Hadir</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->no_ba_tidak_hadir ? $letter->no_ba_tidak_hadir : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Visit</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_visit ? $letter->tanggal_visit->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Hasil Visit</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->hasil_visit ? $letter->hasil_visit : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Nomor LHP2DK</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->no_lhp2dk }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal LHP2DK</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_lhp2dk ? $letter->tanggal_lhp2dk->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Keputusan</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->keputusan ? $letter->keputusan : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Kesimpulan</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->kesimpulan ? $letter->kesimpulan : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Potensi Akhir</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">Rp. {{ $letter->potensi_akhir ? number_format($letter->potensi_akhir) : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Realisasi</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">Rp. {{ $letter->realisasi ? number_format($letter->realisasi) : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Setor</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_setor ? $letter->tanggal_setor->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal Usul Pemeriksaan</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_usul_pemeriksaan ? $letter->tanggal_usul_pemeriksaan->format('Y/m/d') : '-' }}</p>
                </div>
                <div class="col-md-5">
                    <label>Nomor DSPP</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->no_dspp }}</p>
                </div>
                <div class="col-md-5">
                    <label>Tanggal DSPP</label>
                </div>
                <div class="col-md-7 form-group">
                    <p class="fs-6 fw-bold">{{ $letter->tanggal_dspp ? $letter->tanggal_dspp->format('Y/m/d') : '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('/') }}assets/vendors/maskjs/jquery.mask.js"></script>
    
    <script>
        // $('*#money').mask("#.##0", {reverse: true});
    </script>
@endpush