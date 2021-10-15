@extends('layouts.base', ['title' => 'MoSART - Edit Data Pengguna'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/assets/css/select2.min.css" />
@endpush

@section('section-header')
    <h1>Edit User</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header mb-3">
                <div class="col-md-6">
                    <a href="{{ route('user.index') }}">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-md-6">
                    Edit Data Pengguna
                </div>
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
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="John Doe" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nomor Induk Pegawai</label>
                        <input type="text" class="form-control" name="nip" id="nip" value="{{ $user->nip }}" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail Pengguna</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="john.doe@example.com">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Seksi</label>
                        <select class="form-control select2" name="section_id">
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}" {{ $user->section_id == $section->id ? 'selected' : '' }}>{{ $section->nama_seksi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jabatan</label>
                        <div class="form-group">
                            <select class="select2 form-control" name="position_id">
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ $user->position_id == $position->id ? 'selected' : '' }}>{{ $position->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-right mt-2">
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