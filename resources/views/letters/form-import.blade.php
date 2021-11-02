@extends('layouts.base', ['title' => 'MoSART - Import Data SP2DK'])

@section('section-header')
    <h1>Import Data SP2DK</h1>
@endsection

@section('content')
    {{-- All letter --}}
    <div class="row">
        <div class="col-md-9">
            {{-- Logic for error or success --}}
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
        
            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        
            @if (session()->has('failures'))
        
                <table class="table table-danger">
                    <tr>
                        <th>Row</th>
                        <th>Attribute</th>
                        <th>Errors</th>
                        <th>Value</th>
                    </tr>
        
                    @foreach (session()->get('failures') as $validation)
                        <tr>
                            <td>{{ $validation->row() }}</td>
                            <td>{{ $validation->attribute() }}</td>
                            <td>
                                <ul>
                                    @foreach ($validation->errors() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                {{ $validation->values()[$validation->attribute()] }}
                            </td>
                        </tr>
                    @endforeach
                </table>
        
            @endif
            {{-- end of logic --}}
            {{-- <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6">
                        <a href="{{ route('letter.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">Import Seluruh Data SP2DK</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('letter.import.all') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md mb-1">
                            <fieldset>
                                <label for="formFile" class="form-label">Pilih file excel yang ingin di import.</label>
                                <div class="input-group">
                                    <input type="file" name="all-letter" class="form-control" id="inputGroupFile04"
                                        aria-describedby="inputGroupFileAddon04"
                                        aria-label="Upload">
                                    <button type="submit" class="btn btn-primary" type="button"
                                        id="inputGroupFileAddon04">Upload</button>
                                </div>
                                <p class="text-primary mt-2">Isi data yang dapat di import adalah seluruh data sp2dk.</p>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>

    {{-- First letter --}}
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6">
                        <a href="{{ route('letter.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">Import Data SP2DK</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('letter.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md mb-1">
                            <fieldset>
                                <label for="formFile" class="form-label">Pilih file excel yang ingin di import.</label>
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control" id="inputGroupFile04"
                                        aria-describedby="inputGroupFileAddon04"
                                        aria-label="Upload">
                                    <button type="submit" class="btn btn-primary" type="button"
                                        id="inputGroupFileAddon04">Upload</button>
                                </div>
                                <p class="text-primary mt-2">Isi data yang dapat di import adalah nomor sp2dk, tanggal sp2dk, tahun dan potensi awal.</p>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Second letters --}}
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header mb-3">
                        <div class="col-md-6">Import Kirim ke SUKI</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('letter.sendtosuki') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md mb-1">
                            <fieldset>
                                <label for="formFile" class="form-label">Pilih file excel yang ingin di import.</label>
                                <div class="input-group">
                                    <input type="file" name="send-to-suki" class="form-control" id="inputGroupFile04"
                                        aria-describedby="send_to_suki"
                                        aria-label="Upload">
                                    <button type="submit" class="btn btn-primary" type="button"
                                        id="send_to_suki">Upload</button>
                                </div>
                                <p class="text-primary mt-2">Isi data yang dapat di import adalah tanggal kirim ke suki.</p>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Kirim ke pos letters --}}
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6">Import Kirim Pos</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('letter.sendtopos') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md mb-1">
                            <fieldset>
                                <label for="formFile" class="form-label">Pilih file excel yang ingin di import.</label>
                                <div class="input-group">
                                    <input type="file" name="send-to-pos" class="form-control" id="send-to-pos"
                                        aria-describedby="send-to-pos"
                                        aria-label="Upload">
                                    <button type="submit" class="btn btn-primary" type="button"
                                        id="send-to-pos">Upload</button>
                                </div>
                                <p class="text-primary mt-2">Isi data yang dapat di import adalah tanggal kirim pos.</p>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Kembali dari pos letters --}}
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6">Import KemPos</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('letter.backfrompos') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md mb-1">
                            <fieldset>
                                <label for="formFile" class="form-label">Pilih file excel yang ingin di import.</label>
                                <div class="input-group">
                                    <input type="file" name="back-from-pos" class="form-control" id="back-from-pos"
                                        aria-describedby="back-from-pos"
                                        aria-label="Upload">
                                    <button type="submit" class="btn btn-primary" type="button"
                                        id="back-from-pos">Upload</button>
                                </div>
                                <p class="text-primary mt-2">Isi data yang dapat di import adalah tanggal kempos.</p>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Kembali dari pos letters --}}
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header mb-3">
                    <div class="col-md-6">Import LHP2DK</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('letter.importlhp2dk') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md mb-1">
                            <fieldset>
                                <label for="formFile" class="form-label">Pilih file excel yang ingin di import.</label>
                                <div class="input-group">
                                    <input type="file" name="import-lhp2dk" class="form-control" id="import-lhp2dk"
                                        aria-describedby="import-lhp2dk"
                                        aria-label="Upload">
                                    <button type="submit" class="btn btn-primary" type="button"
                                        id="import-lhp2dk">Upload</button>
                                </div>
                                <p class="text-primary mt-2">Isi data yang dapat di import adalah nomor lhp2dk, tanggal lhp2dk, keputusan, kesimpulan, potensi awal, realisasi.</p>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

