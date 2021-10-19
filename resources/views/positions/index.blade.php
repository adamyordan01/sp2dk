@extends('layouts.base', ['title' => 'MoSART - Jabatan'])

@push('style')
    {{-- <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css"> --}}
@endpush

@section('section-header')
    <h1>Daftar Jabatan</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-3">Daftar Jabatan</div>
                    <div class="col-md">
                        <a href="{{ route('position.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Jabatan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
        
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Posisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @forelse ($positions as $position)
                                <tr>
                                    <td>{{ ($positions->currentPage() - 1) * ($positions->perPage()) + $loop->iteration }}</td>
                                    <td>{{ $position->nama_jabatan }}</td>
                                    <td>
                                        <form action="{{ route('position.destroy', $position->id) }}" method="post">
                                            @csrf
                                            @method('delete')
        
                                            <a href="{{ route('position.edit', $position->id) }}" class="btn btn-sm btn-secondary">
                                                <i class="far fa-edit"></i> Edit
                                            </a>
        
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Realy?|Do you want to continue?');">
                                                <i class="far fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data Belum Tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody> --}}
                    </table>
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
            $('.data-table').DataTable({
                // dom: 'lBfrtip',
                // buttons: ['copy', 'excel', 'pdf', 'csv', 'print'],
                processing: true,
                serverside: true,
                ajax: "{{ route('position.get-positions') }}",
                columns: [
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'nama_jabatan', name:'nama_jabatan'},
                    {data: 'action', name:'action', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false},
                ]
            })
        });

        $(document).on('click', '#deleteButton', function() {
            var position_id = $(this).data('id');
            var url = '{{ route('position.destroy') }}';

            swal.fire({
                title: 'Apakah anda yakin',
                html: 'Kamu akan menghapus jabatan ini?',
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'Ya hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.post(url, {position_id:position_id}, function(data) {
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
    </script>
@endpush