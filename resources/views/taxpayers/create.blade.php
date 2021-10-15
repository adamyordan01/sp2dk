@extends('layouts.base', ['title' => 'MoSART - Tambah Data Wajib Pajak'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/assets/css/select2.min.css" />
@endpush

@section('section-header')
    <h1>Tambah Data Wajib Pajak</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6 pl-0">
                        <a href="{{ route('taxpayer.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">Tambah Data Wajib Pajak</div>
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
                    <form action="{{ route('taxpayer.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">NPWP</label>
                            <input type="number" class="form-control" name="npwp" placeholder="Nomor Pokok Wajib Pajak">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Wajib Pajak</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Wajib Pajak">
                        </div>
                        <div class="form-group">
                            <label for="">Nama AR</label>
                            <div class="form-group">
                                <select class="select2 form-control" name="user_id">
                                    @foreach ($ar as $user_ar)
                                        <option value="{{ $user_ar->id }}">{{ $user_ar->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kepala Seksi</label>
                            <div class="form-group">
                                <select class="select2 form-control" name="kasi_id">
                                    @foreach ($kasi as $user_kasi)
                                        <option value="{{ $user_kasi->id }}">{{ $user_kasi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fab fa-telegram-plane"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/assets/js/page/select2.full.min.js"></script>
@endpush