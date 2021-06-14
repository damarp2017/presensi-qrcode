@extends('layouts.base')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<style media="screen">
  video {
    /* override other styles to make responsive */
    width: 100% !important;
    height: auto !important;
  }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('main')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Absensi Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Absensi Siswa</li>
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
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="card-title mb-3">Kamera Scan Absensi</h5>
                </div>
                <div class="col-md-6">
                  <h5 class="card-title mb-3 float-right" id="clock-wrapper"></h5>
                </div>
              </div>
              <video id="preview"></video>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-3">Test Absensi Siswa</h5>
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
<script src="{{ asset('assets/adminlte/plugins/instascan/instascan.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
  const soundSuccess = '/assets/adminlte/sound/success.mp3';
    const soundFailed = '/assets/adminlte/sound/failed.mp3';
    const start = new Date;

    setInterval(function() {
        var today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        h = checkTime(h);
        m = checkTime(m);
        s = checkTime(s);
        $('#clock-wrapper').html("<b>"+
            h + ":" + m + ":" + s
            +"</b>");
    }, 500);

    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }


     let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
     scanner.addListener('scan', function (content) {
       getStudent(content)
     });

     Instascan.Camera.getCameras().then(function (cameras) {
       if (cameras.length > 0) {
         scanner.start(cameras[0]);
       } else {
         console.error('No cameras found.');
       }
     }).catch(function (e) {
       console.error(e);
     });

       function showAlert(res){
        const audio = new Audio(res.status ? soundSuccess : soundFailed);
        audio.play();

         Swal.fire({
               title: res.message,
               text: res.data.name ? res.data.name +" "+ res.data.grade : 'Data siswa tidak ditemukan',
               icon: res.status ? 'success' : 'error',
               timer: 2000,
               showCancelButton: false,
               showConfirmButton: false
           });
       }

       function getStudent(nisn){
         $.ajax({
           method: "POST",
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           url : `/attendances/${nisn}/student`
         }).done(function(res) {
             showAlert(res)
         })
       }

</script>
@endpush