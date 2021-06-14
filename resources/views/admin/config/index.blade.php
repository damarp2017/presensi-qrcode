@extends('layouts.base')

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
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Absensi berangkat</label>
                      <input type="email" name="in_begin" value="{{old('in_begin', $config ? $config->in_begin : '')}}" class="form-control" id="exampleInputEmail1" placeholder="Absensi berangkat">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Absensi berangkat berakhir</label>
                      <input type="email" name="in_over" value="{{old('in_over', $config ? $config->in_over : '')}}" class="form-control" id="exampleInputEmail1" placeholder="Absensi berangkat berakhir">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Absensi pulang</label>
                      <input type="email" name="out_begin" value="{{old('out_begin', $config ? $config->out_begin : '')}}" class="form-control" id="exampleInputEmail1" placeholder="Absensi pulang">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Absensi pulang berakhir</label>
                      <input type="email" name="out_over" value="{{old('out_over', $config ? $config->out_over : '')}}" class="form-control" id="exampleInputEmail1" placeholder="Absensi berangkat berakhir">
                    </div>

                  </div>
                  <!-- /.card-body -->

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
