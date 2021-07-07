@extends('layouts.base')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/toastr/toastr.min.css') }}">
@endpush
@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Absensi Manual</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
          <div class="row">
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Absensi Berangkat</h3>
              </div>

              <form method="post" action="{{route('admin.attendance-in.manual.update')}}">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label>NISN</label>
                    <input type="telp" class="form-control" name="nisn" placeholder="" required>
                  </div>
                  <div class="form-group">
                      <label>Absent Siswa</label>
                      <select class="form-control" name="absent">
                        <option value="" selected>Masuk</option>
                        <option value="S">Sakit</option>
                        <option value="I">Izin</option>
                        <option value="A">Alfa</option>
                      </select>
                    </div>
                      <div class="form-group">
                        <label>Tanggal</label>
                          <div class="input-group date" id="attendaceDateIn" data-target-input="nearest">
                              <input type="text" name="date_in" class="form-control datetimepicker-input" data-target="#attendaceDateIn" placeholder="{{now()->format('d-m-Y')}}"
                              value="{{ now()->format('d/m/Y')}}">
                              <div class="input-group-append" data-target="#attendaceDateIn" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            <!-- /.card -->
            </div>
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Absensi Pulang</h3>
              </div>

              <form method="post" action="{{route('admin.attendance-out.manual.update')}}">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label>NISN</label>
                    <input type="telp" class="form-control" name="nisn" placeholder="" required>
                  </div>
                    <div class="form-group">
                      <label>Tanggal</label>
                        <div class="input-group date" id="attendaceDateOut" data-target-input="nearest">
                            <input type="text" name="date_out" class="form-control datetimepicker-input" data-target="#attendaceDateOut" placeholder="{{now()->format('d-m-Y')}}"
                            value="{{ now()->format('d/m/Y')}}">
                            <div class="input-group-append" data-target="#attendaceDateOut" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            <!-- /.card -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Page specific script -->
<script>
    $('#attendaceDateIn').datetimepicker({
     format : "DD-MM-YYYY",
     maxDate: Date.now()
    });
    $('#attendaceDateOut').datetimepicker({
     format : "DD-MM-YYYY",
     maxDate: Date.now()
    });
</script>
@if ($message = Session::get('success'))
<script>
    message = {!! json_encode($message) !!}
    $(function() {
        toastr.success(message);
    });
</script>
@endif
@if ($message = Session::get('error'))
<script>
    message = {!! json_encode($message) !!}
    $(function() {
        toastr.error(message);
    });
</script>
@endif
@endpush
