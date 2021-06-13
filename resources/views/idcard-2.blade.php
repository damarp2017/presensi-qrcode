<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css" media="all">
        body {
            margin: 0;
            padding: 0;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .container {
            width: 80mm;
            height: 125mm;
            padding: 10px;
            border: 2px solid black;
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

        .flex {
            display: flex;
        }

        .flex-col {
            display: flex;
            flex-direction: column;
        }

        .justify-between {
            justify-content: space-between;
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

        .justify-center {
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container flex-col justify-between">
        <div class="bg-blue p-5">
            <div class="text-white font-extrabold text-center text">
                QRCode CARD
            </div>
        </div>
        <div class="flex-col">
            <div class="flex justify-center mb-2">
                <div class="border-2 border-blue p-5">
                    <img src="data:image/png;base64, {{ $qrcode }}">
                    {{-- {!! QrCode::size(200)->eyeColor(0, 255, 69, 0, 30, 144, 255)->generate('Lorem Ipsum
                    Dolor!'); !!} --}}
                </div>
            </div>
            <div class="text-center text-xl font-extrabold">
                Damar Permadany
            </div>
            <div class="text-center text-lg">
                1234567890 / 7-A
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