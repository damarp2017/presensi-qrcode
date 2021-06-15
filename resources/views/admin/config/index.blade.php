@extends('layouts.base')
@push('styles')
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/toastr/toastr.min.css') }}">
@endpush
@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konfigurasi Absensi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Konfigurasi Absensi</li>
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
              <div class="col-md-12">
              <div class="card">
                <form action="{{route('admin.config.update')}}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Absensi berangkat</label>
                            <div class="input-group date" id="timepicker1" data-target-input="nearest">
                              <input type="text" name="in_begin" value="{{old('in_begin', $config ? $config->in_begin : '')}}" class="form-control datetimepicker-input" data-target="#timepicker1" placeholder="Absensi berangkat" required>
                              <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Absensi berangkat berakhir</label>
                            <div class="input-group date" id="timepicker2" data-target-input="nearest">
                              <input type="text" name="in_over" value="{{old('in_over', $config ? $config->in_over : '')}}" class="form-control datetimepicker-input" data-target="#timepicker2" placeholder="Absensi berangkat berakhir" required>
                              <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Absensi pulang</label>
                            <div class="input-group date" id="timepicker3" data-target-input="nearest">
                              <input type="text" name="out_begin" value="{{old('out_begin', $config ? $config->in_over : '')}}" class="form-control datetimepicker-input" data-target="#timepicker3" placeholder="Absensi berangkat berakhir" required>
                              <div class="input-group-append" data-target="#timepicker3" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Absensi pulang berakhir</label>
                            <div class="input-group date" id="timepicker4" data-target-input="nearest">
                              <input type="text" name="out_over" value="{{old('out_over', $config ? $config->out_over : '')}}" class="form-control datetimepicker-input" data-target="#timepicker4" placeholder="Absensi berangkat berakhir" required>
                              <div class="input-group-append" data-target="#timepicker4" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                            </div>
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
<script src="{{ asset('assets/adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script type="text/javascript">

$('.date').each(function() {
   $(this).datetimepicker({
     format: 'HH:mm',
      pickDate: false,
      pickSeconds: false,
      pick12HourFormat: false
  })
})

</script>
@if ($message = Session::get('success'))
<script>
    message = {!! json_encode($message) !!}
    console.log(message);
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
