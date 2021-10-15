@extends('layouts.base', ['title' => 'MoSART - Tambah Data Seksi'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6">
                        <a href="{{ route('section.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">Tambah Data Seksi</div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
    
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('section.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Nama Seksi</label>
                            <input type="text" class="form-control" name="nama_seksi" placeholder="Nama seksi..." autofocus>
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