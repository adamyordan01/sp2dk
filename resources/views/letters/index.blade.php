@extends('layouts.base', ['title' => 'MoSART - Daftar SP2DK'])

@push('style')
    <link rel="stylesheet" href="https://nightly.datatables.net/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

    <style>
        table {
            table-layout: auto !important;
        }

        td.action {
            min-width: 180px !important;
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
    <h1>Daftar SP2DK</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-3">Daftar SP2DK</div>
                    <div class="col-md">
                        @can('create', \App\Models\Letter::class)
                            <a href="{{ route('letter.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Tambah SP2DK
                            </a>
                        @endcan
                        @can('import', \App\Models\Letter::class)
                            <a href="{{ route('letter.form-import') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-upload"></i> Import SP2DK (Excel)
                                {{-- <i class="fas fa-file-import"></i> Import Wajib Pajak (Excel) --}}
                            </a>
                        @endcan
                        {{-- @if (Auth::user()->position->nama_jabatan == "Kepala Seksi")
                            <a href="{{ route('letter.export') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i> Export SP2DK (Excel)
                            </a>
                        @endif
                        @if (Auth::user()->position->nama_jabatan == "Account Representative")
                            <a href="{{ route('letter.export-ar') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i> Export SP2DK (Excel)
                            </a>
                        @endif
                        @if (Auth::user()->position->nama_jabatan == "Kepala Kantor")
                            <a href="{{ route('letter.export-kk') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i> Export SP2DK (Excel)
                            </a>
                        @endif --}}
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
                        <table class="table table-bordered hover data-table" id="letter-table">
                            <thead>
                                <tr>
                                    <th class="third">
                                        <input type="checkbox" name="main_checkbox">
                                        <button class="btn btn-danger ml-3 d-none" id="deleteAllButton">Hapus</button>
                                    </th>
                                    <th>#</th>
                                    <th>NPWP</th>
                                    <th class="third">Nama</th>
                                    <th class="third">AR</th>
                                    <th class="third">Seksi</th>
                                    <th>Nomor SP2DK</th>
                                    <th>Tanggal SP2DK</th>
                                    <th class="fourth">Tahun SP2DK</th>
                                    <th class="fourth">Tahun Pajak</th>
                                    <th class="third">Potensi Awal</th>
                                    <th>Tanggal Kirim ke SUKI</th>
                                    <th>Tanggal Kirim POS</th>
                                    <th>Tanggal Kempos</th>
                                    <th>Tanggal Telp WP</th>
                                    <th>Hasil Telp WP</th>
                                    <th>Tanggal Konseling</th>
                                    <th>Hasil Konseling</th>
                                    <th>Tanggal BA Tidak Hadir</th>
                                    <th>No BA Tidak Hadir</th>
                                    <th>Tanggal Visit</th>
                                    <th>Hasil Visit</th>
                                    <th>Nomor LHP2DK</th>
                                    <th>Tanggal LHP2DK</th>
                                    <th>Keputusan</th>
                                    <th>Kesimpulan</th>
                                    <th class="third">Potensi Akhir</th>
                                    <th class="third">Realisasi</th>
                                    <th>Tanggal Setor</th>
                                    <th>Tanggal Usul Pemeriksaan</th>
                                    <th>No DSPP</th>
                                    <th>Tanggal DSPP</th>
                                    <th>Action
                                        {{-- <button class="btn btn-danger d-none" id="deleteAllButton">Hapus</button> --}}
                                    </th>
                                </tr>
                                {{-- <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr> --}}
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script>

    <script>
        $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
        });

        $(document).ready(function() {
            $('.data-table').DataTable({
                dom: 'lBfrtip',
                aLengthMenu: [
                    [5, 10, 20, 50, 100, -1],
                    [5, 10, 20, 50, 100, "all"]
                ],
                buttons: ['copy', 'excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }],
                processing: true,
                serverside: true,
                ajax: "{{ route('letter.data') }}",
                columns: [
                    {data: 'checkbox', name:'checkbox', 'orderable': false, 'searchable': false},
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'taxpayer.npwp', name:'taxpayer.npwp'},
                    {data: 'taxpayer.nama', name:'taxpayer.nama'},
                    {data: 'taxpayer.user.name', name:'taxpayer.user.name'},
                    {data: 'taxpayer.user.section.nama_seksi', name:'taxpayer.user.section.nama_seksi'},
                    {data: 'no_sp2dk', name:'no_sp2dk'},
                    {data: 'tanggal_sp2dk', name:'tanggal_sp2dk'},
                    {data: 'tahun_sp2dk', name:'tanggal_sp2dk'},
                    {data: 'tahun', name:'tahun'},
                    {data: 'potensi_awal', name:'potensi_awal', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
                    {data: 'tanggal_kirim_suki', name:'tanggal_kirim_suki'},
                    {data: 'tanggal_kirim_pos', name:'tanggal_kirim_pos'},
                    {data: 'tanggal_kempos', name:'tanggal_kempos'},
                    {data: 'tanggal_telpon_wp', name:'tanggal_telpon_wp'},
                    {data: 'hasil_telpon_wp', name:'hasil_telpon_wp'},
                    {data: 'tanggal_konseling', name:'tanggal_konseling'},
                    {data: 'hasil_konseling', name:'hasil_konseling'},
                    {data: 'tanggal_ba_tidak_hadir', name:'tanggal_ba_tidak_hadir'},
                    {data: 'no_ba_tidak_hadir', name:'no_ba_tidak_hadir'},
                    {data: 'tanggal_visit', name:'tanggal_visit'},
                    {data: 'hasil_visit', name:'hasil_visit'},
                    {data: 'no_lhp2dk', name:'no_lhp2dk'},
                    {data: 'tanggal_lhp2dk', name:'tanggal_lhp2dk'},
                    {data: 'keputusan', name:'keputusan'},
                    {data: 'kesimpulan', name:'kesimpulan'},
                    {data: 'potensi_akhir', name:'potensi_akhir', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
                    {data: 'realisasi', name:'realisasi', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
                    {data: 'tanggal_setor', name:'tanggal_setor'},
                    {data: 'tanggal_usul_pemeriksaan', name:'tanggal_usul_pemeriksaan'},
                    {data: 'no_dspp', name:'no_dspp'},
                    {data: 'tanggal_dspp', name:'tanggal_dspp'},
                    {data: 'action', name:'action', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false},
                ],

                initComplete: function () {
                    this.api().columns([3,4,5,8,9]).every( function () {
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

            }).on('draw', function() {
                $('input[name="letter_checkbox"]').each(function() {
                    this.checked = false;
                });
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllButton').addClass('d-none');
            });

            // $('.filter-select').change(function() {
            //     table.column($(this).data('column'))
            //     .search($(this).val())
            //     .draw();
            // });

            

        });

        $(document).on('click', '#deleteButton', function() {
            var letter_id = $(this).data('id');
            var url = '{{ route('letter.destroy') }}';

            swal.fire({
                title: 'Apakah anda yakin',
                html: 'Kamu akan menghapus data sp2dk ini?',
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'Ya hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.post(url, {letter_id:letter_id}, function(data) {
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
                $('input[name="letter_checkbox"]').each(function() {
                    this.checked = true;
                })
            } else {
                $('input[name="letter_checkbox"]').each(function() {
                    this.checked = false;
                })
            }

            toggledeleteAllButton();
        });

        $(document).on('change', 'input[name="letter_checkbox"]', function() {
            if ($('input[name="letter_checkbox"]').length == $('input[name="letter_checkbox"]:checked').length) {
                $('input[name="main_checkbox"]').prop('checked', true);
            } else {
                $('input[name="main_checkbox"]').prop('checked', false);
            }

            toggledeleteAllButton();
        })

        function toggledeleteAllButton() {
            if ($('input[name="letter_checkbox"]:checked').length > 0) {
                $('button#deleteAllButton').text('Delete ('+$('input[name="letter_checkbox"]:checked').length+')').removeClass('d-none');
            } else {
                $('button#deleteAllButton').addClass('d-none');
            }
        }

        $(document).on('click', 'button#deleteAllButton', function() {
            var checkedLetters = [];
            $('input[name="letter_checkbox"]:checked').each(function() {
                checkedLetters.push($(this).data('id'));
            });
            // alert(checkedLetters);
            var url = '{{ route("letter.delete.selected") }}';

            if (checkedLetters.length > 0) {
                swal.fire({
                    title: 'Apakah anda yakin?',
                    html: 'Kamu akan menghapus <b>'+checkedLetters.length+'</b> data sp2dk',
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonText: 'Ya hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    allowOutsideClick: false
                }).then(function(result) {
                    if (result.value) {
                        $.post(url, {letters_id:checkedLetters}, function(data) {
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
            // lengthChange: true,
            // paging: true,
            // iDisplayLength: 5,
            aLengthMenu: [[ 5, 10, 20, 50, 100 ,-1],[5,10,20,50,100,"all"]],
            initComplete: function () {
                    this.api().columns([2,3,6,7]).every( function () {
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
