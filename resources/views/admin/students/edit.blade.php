@extends('layouts.base')

@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/toastr/toastr.min.css') }}">
@endpush

@push('scripts')
<!-- Select2 -->
<script src="{{ asset('assets/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/adminlte/plugins/toastr/toastr.min.js') }}"></script>

<script>
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

</script>

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
                    <h1 class="m-0">Ubah Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Ubah Siswa</li>
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
                            <h3 class="card-title">Form Ubah Siswa</h3>
                        </div>
                        <form action="{{ route('admin.student.update', $student) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control select2bs4" style="width: 100%;" required
                                        name="grade_id">
                                        <option value="" selected="selected">-- Pilih Kelas --</option>
                                        @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}" {{$grade->id == $student->grade_id ? 'selected' : ''}}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nisn">NISN Siswa</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn"
                                        placeholder="Masukan NISN Siswa" required autofocus value="{{ old('nisn',$student->nisn) }}"
                                        maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Siswa</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan Nama Siswa" required value="{{ old('name', $student->name) }}">
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-info d-inline">
                                        <input type="radio" name="gender" id="male" value="male" {{$student->gender == 'male' ? 'checked' : ''}}>
                                        <label for="male">Laki-laki</label>
                                    </div>
                                    &ensp;
                                    <div class="icheck-info d-inline">
                                        <input type="radio" name="gender" id="female" value="female" {{$student->gender == 'female' ? 'checked' : ''}}>
                                        <label for="female">Perempuan</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Kontak Siswa</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Masukan Kontak Siswa" required value="{{ old('phone', $student->phone) }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat Siswa</label>
                                    <textarea class="form-control" rows="3" id="address" name="address" required
                                        placeholder="Masukan Alamat Siswa">{{ old('address', $student->address) }}</textarea>
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
