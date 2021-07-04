@extends('layouts.base')
@push('styles')
<!-- Datatables plugin -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                    <h1 class="m-0">Rekap Absensi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Beranda</a></li>
                        <li class="breadcrumb-item">Rekap Absensi</li>
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
              <div class="card">
                  <div class="card-body">
                    <form action="" method="get">
                      <div class="row">
                        <div class="col-md-3 col-6">
                          <div class="form-group">
                              <div class="input-group date" id="date-start" data-target-input="nearest">
                                  <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#date-start" placeholder="{{now()->format('d-m-Y')}}"
                                  value="{{ Request::get('start_date') ? Request::get('start_date') : now()->format('d/m/Y')}}">
                                  <div class="input-group-append" data-target="#date-start" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-1 col-3 mt-2 text-center">
                          <p>Sampai</p>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="form-group">
                              <div class="input-group date-finish" id="date-finish" data-target-input="nearest">
                                  <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#date-finish" placeholder="{{now()->format('d-m-Y')}}"
                                  value="{{ Request::get('end_date') ? Request::get('end_date') : now()->format('d/m/Y')}}">
                                  <div class="input-group-append" data-target="#date-finish" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div>
                        </div>
                          <div class="col-md-2 col-4">
                              <div class="form-group">
                                <select class="form-control" name="grade">
                                  <option value="">Kelas</option>
                                  @foreach($grades as $grade)
                                    <option value="{{$grade->id}}" {{Request::get('grade') == $grade->id ? 'selected' : ''}}>{{$grade->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-1 col-4">
                              <button type="submit" name="search" value="search" class="btn btn-block btn-primary"> <i class="fas fa-search"></i>
                              </button>
                            </div>
                            <div class="col-md-1 col-4">
                              <button type="submit" name="print" value="print" class="btn btn-block btn-success"> <i class="fas fa-print"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      <table id="list-attendance" class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>NISN</th>
                                  <th>Nama Siswa</th>
                                  <th>Kelas</th>
                                  <th>Status</th>
                                  <th>Tanggal</th>
                                  <th>Absen Berangkat</th>
                                  <th>Absen Pulang</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($attendances as $attendance)
                            <tr>
                                <td></td>
                                <td>{{ $attendance->student->nisn }}</td>
                                <td>{{ $attendance->student->name }}</td>
                                <td>{{ $attendance->student->grade->name }}</td>
                                <td>{{ $attendance->status() }}</td>
                                <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                <td>{{ $attendance->timeAttendanceIn() }}</td>
                                <td>{{ $attendance->timeAttendanceOut() }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th>No</th>
                                  <th>NISN</th>
                                  <th>Nama Siswa</th>
                                  <th>Kelas</th>
                                  <th>Status</th>
                                  <th>Tanggal</th>
                                  <th>Absen Berangkat</th>
                                  <th>Absen Pulang</th>
                              </tr>
                          </tfoot>
                      </table>
                  </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Page specific script -->
<script>
    $(function () {
      let t = $('#list-attendance').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "order": [[1, 'asc']],
        "language": {
            "emptyTable": "Tidak ada data siswa yang ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "infoEmpty": "",
            "paginate": {
               "first":      "Awal",
               "last":       "Akhir",
               "next":       "Lanjut",
               "previous":   "Kembali"
             },
        },
        "oLanguage": {
            "sSearch": "Cari"
        }
      });
      t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    });

    $('#date-start').datetimepicker({
     format : "DD-MM-YYYY"
    });
    $('#date-finish').datetimepicker({
     format : "DD-MM-YYYY"
    });
</script>
@endpush
