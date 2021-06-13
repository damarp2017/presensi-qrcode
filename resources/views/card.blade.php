<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $student->grade->name . '-' . $student->name }}</title>
    <style type="text/css" media="all">
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80mm;
            height: 125mm;
            padding: 10px;
            border: 2px solid black;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .bg-blue {
            background-color: #00a8e8;
        }

        .p-5 {
            padding: 1.25rem
                /* 20px */
            ;
        }

        .text-white {
            color: white;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-extrabold {
            font-weight: 800;
        }

        .text-lg {
            font-size: 1.125rem
                /* 18px */
            ;
            line-height: 1.75rem
                /* 28px */
            ;
        }

        .text-xl {
            font-size: 1.25rem
                /* 20px */
            ;
            line-height: 1.75rem
                /* 28px */
            ;
        }

        .text-center {
            text-align: center;
        }

        .border-2 {
            border: 2px solid #00a8e8;
        }

        .border-blue {
            border-color: #00a8e8;
        }

        .p-5 {
            padding: 1.25rem
                /* 20px */
            ;
        }

        .mb-2 {
            margin-bottom: 0.5rem
                /* 8px */
            ;
        }

        .mb-5 {
            margin-bottom: 1.25rem
                /* 8px */
            ;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="bg-blue p-5 mb-5">
            <div class="text-white font-extrabold text-center text">
                QRCode CARD
            </div>
        </div>
        <div class="text-center mb-2">
            <img src="data:image/png;base64, {{ $qrcode }}">
            {{-- {!! QrCode::size(235)->eyeColor(0, 255, 69, 0, 30, 144, 255)->generate('Lorem Ipsum
            Dolor!'); !!} --}}
        </div>
        <div class="mb-5">
            <div class="text-center text-xl font-extrabold">
                {{ $student->name }}
            </div>
            <div class="text-center text-lg">
                {{ $student->nisn . ' / ' . $student->grade->name }}
            </div>
        </div>
        <div class="bg-blue p-5">
            <div class="text-white font-extrabold text-center text">
                QRCode CARD
            </div>
        </div>
    </div>
</body>

</html>