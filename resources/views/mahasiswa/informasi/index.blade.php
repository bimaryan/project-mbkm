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
    <title>SILK &mdash; Informasi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            font-style: normal;
        }
    </style>
</head>

<body>
    @include('mahasiswa.navbar.index')

    <div class="max-w-screen-xl p-6 mx-auto mt-14">
        <div class="mt-4">
            <p class="text-2xl font-semibold text-center text-green-500">Informasi Laboratorium</p>
            <div class="p-4 mt-4 bg-white border rounded-lg shadow-lg">
                
            </div>
        </div>
    </div>

    @include('mahasiswa.footer.index')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
