@extends('layouts.base', ['title' => 'MoSART - Tambah Data SP2DK'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/assets/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/assets/js/datepicker/bootstrap-datepicker.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('section-header')
    <h1>Tambah Data SP2DK</h1>
@endsection

@section('content')
<div class="col-12 col-lg-7">
    <div class="card">
        <div class="card-header mb-3">
            <div class="col-md-6">
                <a href="{{ route('letter.index') }}">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="col-md-6">Tambah Data SP2DK</div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('letter.store') }}" method="post">
                @csrf

                @can('firstAuthorize', \App\Models\Letter::class)
                    <div class="mb-3">
                        <label for="" class="form-label">Nama WP</label>
                        <div class="form-group">
                            {{-- <select class="choices form-control select2 " name="taxpayer_id">
                                @foreach ($taxpayers as $taxpayer)
                                    <option value="{{ $taxpayer->id }}">{{ $taxpayer->npwp }} - {{ $taxpayer->nama }}</option>
                                @endforeach
                            </select> --}}
                            <select name="taxpayer_id" id="select-taxpayer" class="form-control">
                                <option value="">Pilih Wajib Pajak</option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nomor SP2DK</label>
                        <input type="text" class="form-control" name="no_sp2dk" placeholder="Nomor SP2DK" value="{{ old('no_sp2dk') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal SP2DK</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_sp2dk" placeholder="Tanggal SP2DK" value="{{ old('tanggal_sp2dk') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tahun</label>
                        <input type="number" min="1990" max="2080" class="form-control" name="tahun" placeholder="Tahun" value="{{ old('tahun') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Potensi Awal</label>
                        <input type="text" class="form-control" name="potensi_awal" id="money" placeholder="Potensi Awal" value="{{ old('potensi_awal') }}">
                    </div>
                @endcan

                @can('secondAuthorize', \App\Models\Letter::class)
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Kirim ke SUKI</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_kirim_suki" placeholder="dd/mm/yyyy"  value="{{ old('tanggal_kirim_suki') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Kirim POS</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_kirim_pos" placeholder="dd/mm/yyyy"  value="{{ old('tanggal_kirim_pos') }}">
                    </div>
                @endcan
                
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Kembali POS</label>
                    <input type="text" class="form-control" id="datepicker" name="tanggal_kempos" placeholder="dd/mm/yyyy" value="{{ old('tanggal_kempos') }}">
                </div>

                @can('thirdAuthorize', \App\Models\Letter::class)
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Telp WP</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_telpon_wp" placeholder="dd/mm/yyyy" value="{{ old('tanggal_telpon_wp') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hasil Telp WP</label>
                        <input type="text" class="form-control" name="hasil_telpon_wp" placeholder="Hasil Telp WP" value="{{ old('hasil_telpon_wp') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Konseling</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_konseling" placeholder="dd/mm/yyyy" value="{{ old('tanggal_konseling') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hasil Konseling</label>
                        <input type="text" class="form-control" name="hasil_konseling" value="{{ old('hasil_konseling') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal BA Tidak Hadir</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_ba_tidak_hadir" placeholder="dd/mm/yyyy" value="{{ old('tanggal_ba_tidak_hadir') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nomor BA Tidak Hadir</label>
                        <input type="text" class="form-control" name="no_ba_tidak_hadir" value="{{ old('no_ba_tidak_hadir') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Visit</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_visit" placeholder="dd/mm/yyyy" value="{{ old('tanggal_visit') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hasil Visit</label>
                        <input type="text" class="form-control" name="hasil_visit" placeholder="Hasil Visit" value="{{ old('hasil_visit') }}">
                    </div>
                @endcan

                @can('firstAuthorize', \App\Models\Letter::class)
                    <div class="mb-3">
                        <label for="" class="form-label">Nomor LHP2DK</label>
                        <input type="text" class="form-control" name="no_lhp2dk" placeholder="Nomor LHP2DK" value="{{ old('no_lhp2dk') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal LHP2DK</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_lhp2dk" placeholder="dd/mm/yyyy" value="{{ old('tanggal_lhp2dk') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Keputusan</label>
                        <input type="text" class="form-control" name="keputusan" placeholder="Keputusan" value="{{ old('keputusan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kesimpulan</label>
                        <input type="text" class="form-control" name="kesimpulan" placeholder="Kesimpulan" value="{{ old('kesimpulan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Potensi Akhir</label>
                        <input type="text" class="form-control" id="money" name="potensi_akhir" placeholder="Potensi Akhir" value="{{ old('potensi_akhir') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Realisasi</label>
                        <input type="text" class="form-control" id="money" name="realisasi" placeholder="Realisasi" value="{{ old('realisasi') }}">
                    </div>
                @endcan
                
                @can('thirdAuthorize', \App\Models\Letter::class)
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Setor</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_setor" placeholder="dd/mm/yyyy" value="{{ old('tanggal_setor') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Usul Pemeriksaan</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_usul_pemeriksaan" placeholder="dd/mm/yyyy" value="{{ old('tanggal_usul_pemeriksaan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nomor DSPP</label>
                        <input type="text" class="form-control" name="no_dspp" placeholder="Nomor DSPP" value="{{ old('no_dspp') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal DSPP</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_dspp" placeholder="dd/mm/yyyy" value="{{ old('tanggal_dspp') }}">
                    </div>
                @endcan
                
                {{-- <div class="mb-3">
                    <label for="" class="form-label">Nama AR</label>
                    <div class="form-group">
                        <select class="choices form-select" name="user_id">
                            @foreach ($ar as $user_ar)
                                <option value="{{ $user_ar->id }}">{{ $user_ar->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nama Kepala Seksi</label>
                    <div class="form-group">
                        <select class="choices form-select" name="kasi_id">
                            @foreach ($kasi as $user_kasi)
                                <option value="{{ $user_kasi->id }}">{{ $user_kasi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary float-right mt-3">
                        <i class="fab fa-telegram-plane"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/assets/js/page/select2.full.min.js"></script>
    <script src="{{ asset('/') }}assets/vendors/choices.js/choices.min.js"></script>
    <script src="{{ asset('/') }}assets/assets/js/datepicker/bootstrap-datepicker.js"></script>
    {{-- <script src="{{ asset('/') }}assets/js/pages/form-element-select.js"></script> --}}
    <script src="{{ asset('/') }}assets/assets/js/maskjs/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
        });

        $(document).ready(function() {
            $('#select-taxpayer').select2({
                ajax: {
                    url: "{{ route('letter.get-tax-payer') }}",
                    type: 'get',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return{
                            // _token: csrf_token,
                            search: params.term
                        }
                    },
                    processResults: function(response){
                        return{
                            results: response
                        }
                    }, 
                    cache: true
                }
            })
        })

        $('*#datepicker').datepicker({
            format: "yyyy/mm/dd",
            autoclose: true,
            todayHighlight: true
        });
        $('*#money').mask("#.##0", {reverse: true});

    </script>
@endpush