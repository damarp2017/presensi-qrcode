<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <title>Daftar kehadiran siswa</title>
  </head>
  <body>

    <!-- Header -->
    <header class="bg-primary text-center py-3 mb-4">
      <div class="container">
        <h1 class="font-weight-light text-white">Daftar kehadiran siswa</h1>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card border-primary mb-3">
            <div class="card-header">
              <form action="" method="get">
                <div class="row">
                  <div class="col-md-3 col-6">
                    <div class="form-group">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="date" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="{{now()->format('d-m-Y')}}"
                            value="{{ Request::get('date') ? Request::get('date') : now()->format('d/m/Y')}}" required>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
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
                      <div class="col-md-2 col-4">
                        <div class="form-group">
                          <select class="form-control" name="status">
                            <option value="">Status</option>
                            <option value="M" {{Request::get('status') == 'M' ? 'selected' : ''}}>Masuk</option>
                            <option value="A" {{Request::get('status') == 'A' ? 'selected' : ''}}>Alfa</option>
                            <option value="I" {{Request::get('status') == 'I' ? 'selected' : ''}}>Izin</option>
                            <option value="S" {{Request::get('status') == 'S' ? 'selected' : ''}}>Sakit</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-1 col-4">
                        <button type="submit" class="btn btn-block btn-primary"> <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <table id="list-attendance" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Absent Berangkat</th>
                        <th>Absent Pulang</th>
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
                          <th>Absent Berangkat</th>
                          <th>Absent Pulang</th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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

        $('#reservationdate').datetimepicker({
         format : "DD-MM-YYYY"
        });
    </script>
  </body>
</html>
