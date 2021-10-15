@extends('layouts.base', ['title' => 'MoSART - Ubah Data Wajib Pajak'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/assets/css/select2.min.css" />
@endpush

@section('section-header')
    <h1>Ubah Data Wajib Pajak</h1>
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
                    <div class="col-md-6">Ubah Data Wajib Pajak</div>
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
                    <form action="{{ route('taxpayer.update', $taxpayer->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="" class="form-label">NPWP</label>
                            <input type="number" class="form-control" name="npwp" placeholder="Nomor Pokok Wajib Pajak" value="{{ old('npwp') ?? $taxpayer->npwp }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Nama Wajib Pajak</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Wajib Pajak" value="{{ old('nama') ?? $taxpayer->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama AR</label>
                            <select class="form-control select2" name="user_id">
                                @foreach ($ar as $user_ar)
                                    <option value="{{ $user_ar->id }}" {{ $user_ar->id == $taxpayer->user_id ? 'selected' : '' }}>{{ $user_ar->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kepala Seksi</label>
                            <select class="form-control select2" name="kasi_id">
                                @foreach ($kasi as $user_kasi)
                                    <option value="{{ $user_kasi->id }}"  {{ $user_kasi->id == $taxpayer->kasi_id ? 'selected' : '' }}>{{ $user_kasi->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fab fa-telegram-plane"></i> Ubah
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