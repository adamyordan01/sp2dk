@extends('layouts.base', ['title' => 'MoSART - Tambah Data Pengguna'])

@push('style')
<link rel="stylesheet" href="{{ asset('assets') }}/assets/css/select2.min.css" />
@endpush

@section('section-header')
    <h1>Tambah Data Pengguna</h1>
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
                    <div class="col-md-6">Tambah Data Pengguna</div>
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
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="John Doe" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nomor Induk Pegawai</label>
                            <input type="text" class="form-control" name="nip" id="name" value="{{ old('nip') }}" placeholder="xxxxxxxx" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail Pengguna</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="john.doe@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Seksi</label>
                            <div class="form-group">
                                <select class="select2 form-control" name="section_id">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->nama_seksi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jabatan</label>
                            <div class="form-group">
                                <select class="select2 form-control" name="position_id">
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
        
                        <label for="" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2">
                            <span class="input-group-text" style="cursor: pointer !important;" id="basic-addon2" onclick="password_show_hide();">
                                <i class="fas fa-eye" id="show_eye"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary float-end mt-3">
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
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
@endpush