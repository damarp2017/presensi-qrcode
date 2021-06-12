@extends('layouts.base')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
          <video id="preview"></video>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/adminlte/plugins/instascan/instascan.min.js') }}"></script>
<script type="text/javascript">
     let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
     scanner.addListener('scan', function (content) {
       alert(content);
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
   </script>
@endpush
