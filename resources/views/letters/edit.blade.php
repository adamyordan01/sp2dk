@extends('layouts.base', ['title' => 'MoSART - Ubah Data Surat'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/assets/css/select2.min.css" />    
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/assets/js/datepicker/bootstrap-datepicker.min.css" />
@endpush

@section('section-header')
    <h1>Edit Data SP2DK</h1>
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
                <div class="col-md-6">Ubah Data Surat</div>
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
                <form action="{{ route('letter.update', $letter->id) }}" method="post">
                    @csrf
                    @method('patch')

                    @can('firstAuthorize', \App\Models\Letter::class)
                        <div class="mb-3">
                            <label for="" class="form-label">Nama WP</label>
                            <div class="form-group">
                                {{-- <select class="choices form-control select2" name="taxpayer_id">
                                    @foreach ($taxpayers as $taxpayer)
                                        <option value="{{ $taxpayer->id }}"  {{ $taxpayer->id == $letter->taxpayer_id ? 'selected' : '' }}>{{ $taxpayer->npwp }} - {{ $taxpayer->nama }}</option>
                                    @endforeach
                                </select> --}}
                                <select name="taxpayer_id" id="select-taxpayer" class="form-control">
                                    <option value="{{ $taxpayers->id }}" selected>{{ $taxpayers->nama . " - " . $taxpayers->npwp }}</option>
                                </select>
                                {{-- <input type="text" id="tempTP" class="d-none1" value="{{ $letter->taxpayer_id }}"> --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nomor SP2DK</label>
                            <input type="text" class="form-control" name="no_sp2dk" value="{{ old('no_sp2dk') ?? $letter->no_sp2dk }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal SP2DK</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_sp2dk" placeholder="yyyy/mm/dd" value="{{ old('tanggal_sp2dk',  $letter->tanggal_sp2dk ? $letter->tanggal_sp2dk->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tahun</label>
                            <input type="number" min="1990" max="2080" class="form-control" name="tahun" value="{{ old('tahun') ?? $letter->tahun }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Potensi Awal</label>
                            <input type="text" class="form-control" name="potensi_awal" id="money" value="{{ old('potensi_awal') ?? $letter->potensi_awal }}">
                        </div>
                        
                    @endcan

                    @can('secondAuthorize', \App\Models\Letter::class)
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Kirim ke SUKI</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_kirim_suki" placeholder="yyyy/mm/dd" value="{{ old('tanggal_kirim_suki',  $letter->tanggal_kirim_suki ? $letter->tanggal_kirim_suki->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Kirim POS</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_kirim_pos" placeholder="yyyy/mm/dd" value="{{ old('tanggal_kirim_pos',  $letter->tanggal_kirim_pos ? $letter->tanggal_kirim_pos->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Kembali POS</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_kempos" placeholder="yyyy/mm/dd" value="{{ old('tanggal_kempos', $letter->tanggal_kempos ? $letter->tanggal_kempos->format('Y/m/d') : '') }}">
                        </div>
                    @endcan
                    {{-- <div class="mb-3">
                        <label for="" class="form-label">Tanggal Kembali POS</label>
                        <input type="text" class="form-control" id="datepicker" name="tanggal_kempos" placeholder="yyyy/mm/dd" value="{{ old('tanggal_kempos') ?? $letter->tanggal_kempos ? $letter->tanggal_kempos->format('Y/m/d') : '' }}">
                    </div> --}}

                    @can('thirdAuthorize', \App\Models\Letter::class)
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Telp WP</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_telpon_wp" placeholder="yyyy/mm/dd" value="{{ old('tanggal_telpon_wp', $letter->tanggal_telpon_wp ? $letter->tanggal_telpon_wp->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Hasil Telp WP</label>
                            <input type="text" class="form-control" name="hasil_telpon_wp" value="{{ old('hasil_telpon_wp') ?? $letter->hasil_telpon_wp }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Konseling</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_konseling" placeholder="yyyy/mm/dd" value="{{ old('tanggal_konseling',  $letter->tanggal_konseling ? $letter->tanggal_konseling->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Hasil Konseling</label>
                            <input type="text" class="form-control" name="hasil_konseling" value="{{ old('hasil_konseling') ?? $letter->hasil_konseling }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal BA Tidak Hadir</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_ba_tidak_hadir" placeholder="dd/mm/yyyy" value="{{ old('tanggal_ba_tidak_hadir',  $letter->tanggal_ba_tidak_hadir ? $letter->tanggal_ba_tidak_hadir->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nomor BA Tidak Hadir</label>
                            <input type="text" class="form-control" name="no_ba_tidak_hadir" value="{{ old('no_ba_tidak_hadir') ?? $letter->no_ba_tidak_hadir }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Visit</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_visit" placeholder="yyyy/mm/dd" value="{{ old('tanggal_visit',  $letter->tanggal_visit ? $letter->tanggal_visit->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Hasil Visit</label>
                            <input type="text" class="form-control" name="hasil_visit" value="{{ old('hasil_visit') ?? $letter->hasil_visit }}">
                        </div>
                    @endcan

                    @can('firstAuthorize', \App\Models\Letter::class)
                        <div class="mb-3">
                            <label for="" class="form-label">Nomor LHP2DK</label>
                            <input type="text" class="form-control" name="no_lhp2dk" value="{{ old('no_lhp2dk') ?? $letter->no_lhp2dk }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal LHP2DK</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_lhp2dk" placeholder="yyyy/mm/dd" value="{{ old('tanggal_lhp2dk',  $letter->tanggal_lhp2dk ? $letter->tanggal_lhp2dk->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Keputusan</label>
                            <input type="text" class="form-control" name="keputusan" value="{{ old('keputusan') ?? $letter->keputusan }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Kesimpulan</label>
                            <input type="text" class="form-control" name="kesimpulan" value="{{ old('kesimpulan') ?? $letter->kesimpulan }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Potensi Akhir</label>
                            <input type="text" class="form-control" id="money" name="potensi_akhir" value="{{ old('potensi_akhir') ?? $letter->potensi_akhir }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Realisasi</label>
                            <input type="text" class="form-control" id="money" name="realisasi" value="{{ old('realisasi') ?? $letter->realisasi }}">
                        </div>
                        
                    @endcan

                    @can('thirdAuthorize', \App\Models\Letter::class)
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Setor</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_setor" placeholder="yyyy/mm/dd" value="{{ old('tanggal_setor',  $letter->tanggal_setor ? $letter->tanggal_setor->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Usul Pemeriksaan</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_usul_pemeriksaan" placeholder="yyyy/mm/dd" value="{{ old('tanggal_usul_pemeriksaan',  $letter->tanggal_usul_pemeriksaan ? $letter->tanggal_usul_pemeriksaan->format('Y/m/d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nomor DSPP</label>
                            <input type="text" class="form-control" name="no_dspp" value="{{ old('no_dspp') ?? $letter->no_dspp }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal DSPP</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_dspp" placeholder="yyyy/mm/dd" value="{{ old('tanggal_dspp',  $letter->tanggal_dspp ? $letter->tanggal_dspp->format('Y/m/d') : '') }}">
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
                        <button type="submit" class="btn btn-sm btn-primary float-end mt-3">
                            <i class="fab fa-telegram-plane"></i> Ubah Data
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
    <script src="{{ asset('/') }}assets/js/pages/form-element-select.js"></script>
    <script src="{{ asset('/') }}assets/assets/js/maskjs/jquery.mask.js"></script>
    
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
            });
            // let tp = $('#tempTP').val();
            // console.log(tp);
            // $('#select-taxpayer').val(106698).trigger('change');
        })

        $('*#datepicker').datepicker({
            format: "yyyy/mm/dd",
            autoclose: true,
            todayHighlight: true
        });
        $('*#money').mask("#.##0", {reverse: true});
    </script>
@endpush