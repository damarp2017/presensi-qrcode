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
                    <div class="bg-green-500 h-96 rounded-lg">

                    </div>
                </div>
            </div>
            <div class="w-full xl:w-2/6 h-full px-5 py-5 lg:py-10 xl:py-0">
                <div class="bg-gray-100 border-4 border-blue-500 h-full rounded-lg shadow-lg p-5 xl:p-10">
                    <div class="text-gray-700 font-semibold mb-5">
                        Gunakan form ini saat kamu tidak bawa QR Card
                    </div>
                    <div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-label for="nisn" :value="__('Nisn')" />

                                <x-input id="nisn" class="block mt-1 w-full text-gray-700 bg-gray-50" type="text"
                                    name="nisn" :value="old('nisn')" required autofocus placeholder="Input NISN Kamu" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button
                                    class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>