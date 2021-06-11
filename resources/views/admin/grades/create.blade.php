@extends('layouts.base')

@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/toastr/toastr.min.css') }}">
@endpush

@push('scripts')
<!-- Toastr -->
<script src="{{ asset('assets/adminlte/plugins/toastr/toastr.min.js') }}"></script>

@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    $(function() {
        let error = {!! json_encode($error) !!};
        toastr.error(error);
    });
</script>
@endforeach
@endif

@endpush

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Kelas Baru</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Tambah Kelas Baru</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Kelas Baru</h3>
                        </div>
                        <form action="{{ route('admin.grade.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Kelas</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan Nama Kelas" required autofocus value="{{ old('name') }}">
                                    <span class="text-sm text-primary">*Contoh: 10-A, 10-B, dsb.</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection