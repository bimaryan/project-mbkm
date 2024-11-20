<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- @vite('resources/css/app.css') --}}
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
        <link rel="icon" href="{{ asset('logo/polindra.png') }}" type="image/x-icon">
        <title>SILK &mdash; Katalog</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

            body {
                font-family: "Montserrat", sans-serif;
                font-style: normal;
            }

            .zoom-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .animate-card {
                transform: translateY(50px);
                opacity: 0;
                transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.5s;
            }

            .animate-card.in-view {
                transform: translateY(0);
                opacity: 1;
            }

            .animate-slide {
                transform: translateX(15px);
                opacity: 0;
                transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.5s;
            }

            .animate-slide.in-view {
                transform: translateX(0);
                opacity: 1;
            }
        </style>
    </head>
</head>

<body>
    @include('peminjaman.navbar.index')
</body>

</html>
