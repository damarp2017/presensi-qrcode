<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ID Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.0-canary.14/tailwind.min.css"
        type="text/css">
</head>

<body>
    <div class="w-min-screen p-10">
        <div class="border-2 border-black p-5">
            <div class="bg-blue-500 py-5 mb-5">
                <div class="text-white text-2xl font-bold text-center">
                    ID CARD SMP Al-Fatih 212
                </div>
            </div>
            <div class="flex space-x-5 mb-5">
                <div class="w-1/2">
                    <div class="flex justify-center">
                        <div class="border-2 border-blue-500 p-5">
                            {!! QrCode::size(350)->eyeColor(0, 255, 69, 0, 30, 144, 255)->generate('Lorem Ipsum
                            Dolor!'); !!}
                        </div>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="border border-blue-500 p-5">
                        <div class="mb-4">
                            <div class="text-lg text-gray-600 uppercase font-extrabold">Nisn</div>
                            <div class="text-2xl uppercase text-black font-extrabold">1234567890</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-lg text-gray-600 uppercase font-extrabold">Nama</div>
                            <div class="text-2xl uppercase text-black font-extrabold">Damar Permadany</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-lg text-gray-600 uppercase font-extrabold">Kelas</div>
                            <div class="text-2xl uppercase text-black font-extrabold">9-a</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-lg text-gray-600 uppercase font-extrabold">Alamat</div>
                            <div class="text-2xl uppercase text-black font-extrabold">Kaligangsa Wetan, Brebes</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue-500 py-5">
                <div class="text-white font-bold text-center">
                    Scan QRCode pada saat berangkat dan pulang
                </div>
            </div>
        </div>
    </div>
</body>

</html>