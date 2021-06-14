<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <style media="screen">
      video {
        /* override other styles to make responsive */
        width: 100% !important;
        height: auto !important;
      }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <nav class="flex items-center justify-center flex-wrap bg-blue-500 p-5 lg:p-10">
            <div class="text-white font-semibold text-2xl tracking-tight">
                Al-Fityan Boarding School Bogor
            </div>
        </nav>
        <div class="flex flex-wrap py-5 lg:px-5 lg:py-10">
            <div class="w-full xl:w-4/6 h-full px-5">
                <div class="bg-gray-100 border-4 border-blue-500 h-full rounded-lg shadow-lg p-5 xl:p-10">
                    <div class="text-gray-700 font-semibold mb-5">
                        Scan QR Card kamu disini.
                    </div>
                        <video id="preview" class="bg-green-500 h-96 rounded-lg"></video>

                </div>
            </div>
            <div class="w-full xl:w-2/6 h-full px-5 py-5 lg:py-10 xl:py-0">
                <div class="bg-gray-100 border-4 border-blue-500 h-full rounded-lg shadow-lg p-5 xl:p-10">
                    <div class="text-gray-700 font-semibold mb-5">
                        Gunakan form ini saat kamu tidak bawa QR Card
                    </div>
                    <div>
                        <div>
                            <x-label for="nisn" :value="__('Nisn')" />

                            <input id="nisn" class="block mt-1 w-full text-gray-700 bg-gray-50" type="text"
                                name="nisn" value="" required autofocus placeholder="Input NISN Kamu" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                                onclick="attendaceStudentInput()"
                                >
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>
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
         let selectedCam = cameras[0];
          $.each(cameras, (i, c) => {
           if (c.name.indexOf('back') !== -1) {
               selectedCam = c;
               return false;
           }
       });
         scanner.start(selectedCam);
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

       function attendaceStudentInput(){
         const nisn = $('#nisn').val();
         if(nisn){
           getStudent(nisn);
         }else {
           const audio = new Audio(soundFailed);
           audio.play();
           Swal.fire({
                 title: "Absensi Gagal",
                 text: 'NISN tidak oleh kosong',
                 icon: 'error',
                 timer: 2000,
                 showCancelButton: false,
                 showConfirmButton: false
             });
         }

       }

</script>

</html>
