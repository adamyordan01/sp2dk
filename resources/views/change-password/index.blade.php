@extends('layouts.base', ['title' => 'Ubah Password Pengguna'])

@push('style')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendors/datepicker/bootstrap-datepicker.min.css" />
@endpush

@section('content')
<div class="col-md-6">
    <div class="card">
        <div class="card-header mb-3">
            <div class="row jusify-content-between align-items-center">
                <div class="col-md">Ubah Password Pengguna</div>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <form action="{{ route('change-password.update') }}" method="post">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Password saat ini</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                    @error('current_password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Ulangi Password baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary float-end">
                        <i class="fab fa-telegram-plane"></i> Ubah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('/') }}assets/vendors/maskjs/jquery.mask.js"></script>
    <script src="{{ asset('/') }}assets/vendors/choices.js/choices.min.js"></script>
    <script src="{{ asset('/') }}assets/js/pages/form-element-select.js"></script>
    <script>
        // $('*#money').mask("#.##0", {reverse: true});
    </script>
@endpush