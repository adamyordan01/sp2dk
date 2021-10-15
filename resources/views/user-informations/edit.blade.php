@extends('layouts.base', ['title' => 'MoSART - Informasi Profile User'])

@push('style')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/datepicker/bootstrap-datepicker.min.css" />
@endpush

@section('section-header')
    <h1>Informasi Profile User</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6">
                        <a href="{{ route('dashboard.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">
                        Profile User
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <label>Nama Pengguna</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <p class="fs-6 fw-bold">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="col-md-5">
                            <label>Email Pengguna</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <p class="fs-6 fw-bold">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-md-5">
                            <label>Seksi</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <p class="fs-6 fw-bold">{{ Auth::user()->section->nama_seksi }}</p>
                        </div>
                        <div class="col-md-5">
                            <label>Jabatan</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <p class="fs-6 fw-bold">{{ Auth::user()->position->nama_jabatan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- <div class="col-md-6">
    <div class="card">
        <div class="card-header mb-3">
            <div class="row jusify-content-between align-items-center">
                <div class="col-md">Update Profile User</div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email Pengguna</label>
                <input type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Seksi</label>
                <div class="form-group">
                    <select class="choices form-select" name="section_id" disabled>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ Auth::user()->section_id == $section->id ? 'selected' : '' }}>{{ $section->nama_seksi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Jabatan</label>
                <div class="form-group">
                    <select class="choices form-select" name="section_id" disabled>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ Auth::user()->position_id == $position->id ? 'selected' : '' }}>{{ $position->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary float-end">
                    <i class="fab fa-telegram-plane"></i> Ubah
                </button>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('script')
    <script src="{{ asset('/') }}assets/vendors/maskjs/jquery.mask.js"></script>
    <script src="{{ asset('/') }}assets/vendors/choices.js/choices.min.js"></script>
    <script src="{{ asset('/') }}assets/js/pages/form-element-select.js"></script>
    <script>
        // $('*#money').mask("#.##0", {reverse: true});
    </script>
@endpush