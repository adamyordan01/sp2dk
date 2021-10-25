@extends('layouts.base', ['title' => 'MoSART - Panduan'])

@push('style')
    <style>
        td.checklist {
            font-family: 'Wingdings 2';
            font-size: 20px;
            font-weight: bold;
            color: #2fc92c;
            text-align: center;
        }

        th.header {
            text-align: center;
        }
    </style>
@endpush

@section('section-header')
    <h1>Panduan Aplikasi</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    Halaman Dashboard
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th class="header">Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kepala Kantor</td>
                                <td class="checklist">P</td>
                            </tr>
                            <tr>
                                <td>Kepala Subbag</td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Pelaksana Suki</td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Kepala Seksi Pengawasan</td>
                                <td class="checklist">P</td>
                            </tr>
                            <tr>
                                <td>AR</td>
                                <td class="checklist">P</td>
                            </tr>
                            <tr>
                                <td>Pelaksana Seksi</td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>OC</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Halaman Wajib Pajak
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th class="header">List Wajib Pajak</th>
                                <th class="header">Tambah Wajib Pajak</th>
                                <th class="header">Import Wajib Pajak</th>
                                <th class="header">Import Update Wajib Pajak</th>
                                <th class="header">Edit Wajib Pajak</th>
                                <th class="header">Hapus Wajib Pajak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kepala Kantor</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Kepala Subbag</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Pelaksana Suki</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Kepala Seksi Pengawasan</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                            </tr>
                            <tr>
                                <td>AR</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Pelaksana Seksi</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>OC</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist">P</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Halaman SP2DK
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th class="header">List SP2DK</th>
                                <th class="header">Tambah SP2DK</th>
                                <th class="header">Import SP2DK</th>
                                <th class="header">Edit SP2DK</th>
                                <th class="header">Hapus SP2DK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kepala Kantor</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Kepala Subbag</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Pelaksana Suki</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Kepala Seksi Pengawasan</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                            </tr>
                            <tr>
                                <td>AR</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>Pelaksana Seksi</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist"></td>
                                <td class="checklist"></td>
                            </tr>
                            <tr>
                                <td>OC</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Halaman Jabatan
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th class="header">List Jabatan</th>
                                <th class="header">Tambah Jabatan</th>
                                <th class="header">Edit Jabatan</th>
                                <th class="header">Hapus Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kepala Kantor</td>
                            </tr>
                            <tr>
                                <td>Kepala Subbag</td>
                            </tr>
                            <tr>
                                <td>Pelaksana Suki</td>
                            </tr>
                            <tr>
                                <td>Kepala Seksi Pengawasan</td>
                            </tr>
                            <tr>
                                <td>AR</td>
                            </tr>
                            <tr>
                                <td>Pelaksana Seksi</td>
                            </tr>
                            <tr>
                                <td>OC</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Halaman Seksi
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th class="header">List Seksi</th>
                                <th class="header">Tambah Seksi</th>
                                <th class="header">Edit Seksi</th>
                                <th class="header">Hapus Seksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kepala Kantor</td>
                            </tr>
                            <tr>
                                <td>Kepala Subbag</td>
                            </tr>
                            <tr>
                                <td>Pelaksana Suki</td>
                            </tr>
                            <tr>
                                <td>Kepala Seksi Pengawasan</td>
                            </tr>
                            <tr>
                                <td>AR</td>
                            </tr>
                            <tr>
                                <td>Pelaksana Seksi</td>
                            </tr>
                            <tr>
                                <td>OC</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Halaman User
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th class="header">List User</th>
                                <th class="header">Tambah User</th>
                                <th class="header">Edit User</th>
                                <th class="header">Hapus User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kepala Kantor</td>
                            </tr>
                            <tr>
                                <td>Kepala Subbag</td>
                            </tr>
                            <tr>
                                <td>Pelaksana Suki</td>
                            </tr>
                            <tr>
                                <td>Kepala Seksi Pengawasan</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                            </tr>
                            <tr>
                                <td>AR</td>
                            </tr>
                            <tr>
                                <td>Pelaksana Seksi</td>
                            </tr>
                            <tr>
                                <td>OC</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                                <td class="checklist">P</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush