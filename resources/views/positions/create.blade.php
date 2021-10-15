@extends('layouts.base', ['title' => 'MoSART - Tambah Data Jabatan'])

@section('section-header')
    <h1>Tambah Data Jabatan</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6">
                        <a href="{{ route('position.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">Tambah Data Jabatan</div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
        
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('position.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" placeholder="Nama jabatan...">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary float-right">
                                <i class="fab fa-telegram-plane"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection