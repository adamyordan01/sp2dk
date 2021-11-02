@extends('layouts.base', ['title' => 'MoSART - Download Template Import'])

@push('style')

@endpush

@section('section-header')
    <h1>List Download Template Import</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Download Template Import
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">Download Template Import/Import Update Wajib Pajak</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.wajib-pajak') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">Download Template Import SP2DK</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.sp2dk') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">Download Template Import Kirim Suki</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.kirim-suki') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">Download Template Import Kirim Pos</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.kirim-pos') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">Download Template Import Kempos</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.kempos') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">Download Template Import LHP2DK</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.lhp2dk') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="">Download Template Import Seluruh SP2DK</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.all-sp2dk') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="">Download Template Registrasi Pengguna</div>
                            <div class="my-3">
                                <a href="{{ route('template.download.register-user') }}" class="btn btn-block btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.data-table').DataTable({
                dom: 'lBfrtip',
                buttons: ['copy', 'excel', 'pdf', 'csv', 'print'],
                processing: true,
                serverside: true,
                ajax: "{{ route('user.get-users') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'name', name:'name'},
                    {data: 'nip', name:'nip'},
                    {data: 'position.nama_jabatan', name:'position.nama_jabatan'},
                    {data: 'section.nama_seksi', name:'section.nama_seksi'},
                    {data: 'action', name:'action', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false},
                ]
            })
        })
    </script>
@endpush --}}
