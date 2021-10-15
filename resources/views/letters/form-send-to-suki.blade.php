@extends('layouts.mazer', ['title' => 'Import Kirim ke SUKI'])

@section('content')

<div class="col-12 col-lg-9">
    <div class="card">
        <div class="card-header mb-3">
            <div class="row jusify-content-between align-items-center">
                <div class="col-md-6">Import Kirim ke SUKI</div>
            </div>
        </div>
        <div class="card-body">
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
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

