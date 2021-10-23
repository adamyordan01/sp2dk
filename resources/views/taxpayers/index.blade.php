@extends('layouts.base', ['title' => 'MoSART - Wajib Pajak'])

@push('style')
    <link rel="stylesheet" href="https://nightly.datatables.net/css/dataTables.bootstrap5.min.css">

    <style>
        table {
            table-layout: auto !important;
        }

        table, td {
            border: 1px solid gray !important;
            border-collapse: collapse !important;
        }

        td.first {
            min-width: 250px !important;
        }

        td.second {
            min-width: 200px !important;
        }

        th.third {
            min-width: 150px !important;
        }

        th.fourth {
            min-width: 75px !important;
        }

        th.fifth {
            min-width: 45px !important;
        }
    </style>
@endpush

@section('section-header')
    <h1>Daftar
         Wajib Pajak</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-3">Daftar
                         Wajib Pajak</div>
                    <div class="col-md">
                        @can('create', \App\Models\Taxpayer::class)
                            <a href="{{ route('taxpayer.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Tambah Wajib Pajak
                            </a>
                        @endcan
    
                        @can('import', \App\Models\Taxpayer::class)
                            <a href="{{ route('taxpayer.form-import') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-upload"></i> Import Wajib Pajak (Excel)
                                {{-- <i class="fas fa-file-import"></i> Import Wajib Pajak (Excel) --}}
                            </a>
                            <a href="{{ route('taxpayer.form-update-import') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-upload"></i> Import (Update) Wajib Pajak (Excel)
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
        
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table data-table table-bordered">
                            <thead>
                                <tr>
                                    <th class="third">
                                        <input type="checkbox" name="main_checkbox">
                                        <button class="btn btn-danger ml-3 d-none" id="deleteAllButton">Hapus</button>
                                    </th>
                                    <th>#</th>
                                    <th>NPWP</th>
                                    <th>Nama</th>
                                    <th>Nama AR</th>
                                    <th>Seksi</th>
                                    <th>Kepala Seksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {{-- <td>
                                        <select data-column="3" class="form-control filter-select" id="filter-select">
                                            <option value="">Pilih AR</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user }}">{{ $user }}</option>
                                            @endforeach
                                        </select>  
                                    </td>
                                    <td>
                                        <select data-column="4" class="form-control filter-select" id="filter-select">
                                            <option value="">Pilih Seksi</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section }}">{{ $section }}</option>
                                            @endforeach
                                        </select>  
                                    </td> --}}
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            let table = $('.data-table').DataTable({
                dom: 'lBfrtip',
                buttons: ['excel', 'pdf'],
                processing: true,
                serverside: true,
                ajax: "{{ route('taxpayer.data') }}",
                columns: [
                    {data: 'checkbox', name:'checkbox', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false},
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'npwp', name:'npwp'},
                    {data: 'nama', name:'nama'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'user.section.nama_seksi', name: 'user.section.nama_seksi'},
                    {data: 'kasi.name', name: 'kasi.name'},
                    {data: 'action', name:'action', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false},
                ],

                initComplete: function () {
                    this.api().columns([4,5]).every( function () {
                        var column = this;
                    console.log(this.index())
                        var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo(  $('tfoot td:eq(' + this.index()  + ')') )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }

            });

            // $('.filter-select').change(function() {
            //     table.column($(this).data('column'))
            //     .search($(this).val())
            //     .draw();
            // });

        });

        $(document).on('click', '#deleteButton', function() {
            var taxpayer_id = $(this).data('id');
            var url = '{{ route('taxpayer.destroy') }}';

            swal.fire({
                title: 'Apakah anda yakin',
                html: 'Kamu akan menghapus data wajib pajak ini?',
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'Ya hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.post(url, {taxpayer_id:taxpayer_id}, function(data) {
                        if (data.code == 1) {
                            $('.data-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.message)
                        } else {
                            toastr.error(data.message)
                        }
                    }, 'json');
                }
            })
        })

        $(document).on('click', 'input[name="main_checkbox"]', function(){
            if (this.checked) {
                $('input[name="taxpayer_checkbox"]').each(function() {
                    this.checked = true;
                })
            } else {
                $('input[name="taxpayer_checkbox"]').each(function() {
                    this.checked = false;
                })
            }

            toggledeleteAllButton();
        });

        $(document).on('change', 'input[name="taxpayer_checkbox"]', function() {
            if ($('input[name="taxpayer_checkbox"]').length == $('input[name="taxpayer_checkbox"]:checked').length) {
                $('input[name="main_checkbox"]').prop('checked', true);
            } else {
                $('input[name="main_checkbox"]').prop('checked', false);
            }

            toggledeleteAllButton();
        })

        function toggledeleteAllButton() {
            if ($('input[name="taxpayer_checkbox"]:checked').length > 0) {
                $('button#deleteAllButton').text('Delete ('+$('input[name="taxpayer_checkbox"]:checked').length+')').removeClass('d-none');
            } else {
                $('button#deleteAllButton').addClass('d-none');
            }
        }

        $(document).on('click', 'button#deleteAllButton', function() {
            var checkedTaxpayers = [];
            $('input[name="taxpayer_checkbox"]:checked').each(function() {
                checkedTaxpayers.push($(this).data('id'));
            });
            // alert(checkedTaxpayers);
            var url = '{{ route("taxpayer.delete.selected") }}';

            if (checkedTaxpayers.length > 0) {
                swal.fire({
                    title: 'Apakah anda yakin?',
                    html: 'Kamu akan menghapus <b>'+checkedTaxpayers.length+'</b> data wajib pajak',
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonText: 'Ya hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    allowOutsideClick: false
                }).then(function(result) {
                    if (result.value) {
                        $.post(url, {taxpayers_id:checkedTaxpayers}, function(data) {
                        // $.post(url, {letters_id:letters_id}, function(data) {
                            console.log(data)
                            if (data.code == 1) {
                                $('.data-table').DataTable().ajax.reload(null, true);
                                // toastr.success(data.message);
                                Swal.fire({
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                                })
                            }
                        }, 'json');
                    }
                })
            }
        })

    </script>
@endpush

{{-- @push('script')
    <script src="https://nightly.datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="https://nightly.datatables.net/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready( function () {
    var table = $('#table1').DataTable({
        orderCellsTop: true,
        // lenghtChange: false,
        aLengthMenu: [[ 5, 10, 20, 50, 100 ,-1],[5,10,20,50,100,"all"]],
        initComplete: function () {
                this.api().columns([3,4,5]).every( function () {
                    var column = this;
                console.log(this.index())
                    var select = $('<select class="form-select"><option value=""></option></select>')
                    .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
    
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });
    });
    </script>
@endpush --}}