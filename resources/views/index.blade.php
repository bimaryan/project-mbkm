<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="icon" href="{{ asset('logo/polindra.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>SILK</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            font-style: normal;
        }

        #dropdown {
            width: 100%;
            max-width: 16rem;
        }
    </style>

</head>

<body class="bg-gray-100 dark:bg-gray-800">
    <div id="loading-spinner"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
        <div class="flex flex-col items-center">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <p class="text-white mt-2">Loading, please wait...</p>
        </div>
    </div>


    @include('layout.navbar')
    <div id="content-container" class="opacity-0 transition-opacity duration-500">
        @yield('content')
    </div>
    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    {{-- Datatables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            const content = document.getElementById('content-container');
            content.classList.remove('opacity-0');
            content.classList.add('opacity-100'); // Tampilkan konten dengan transisi
        });

        // Tampilkan spinner ketika halaman mulai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const spinner = document.getElementById('loading-spinner');
            spinner.classList.remove('hidden'); // Tampilkan spinner
        });

        // Sembunyikan spinner setelah halaman selesai dimuat
        window.onload = function() {
            const spinner = document.getElementById('loading-spinner');
            spinner.classList.add('hidden'); // Sembunyikan spinner
        };

        // Tangani jaringan lambat
        let timeout = setTimeout(function() {
            const spinner = document.getElementById('loading-spinner');
            spinner.classList.remove('hidden'); // Tampilkan spinner jika jaringan lambat
        }, 3000); // 3 detik dianggap lambat

        window.addEventListener('load', function() {
            clearTimeout(timeout); // Batalkan timeout jika halaman selesai dimuat
        });
    </script>
</body>

</html>
