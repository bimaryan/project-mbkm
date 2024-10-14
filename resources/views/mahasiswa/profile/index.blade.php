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
    <title>SILK</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            font-style: normal;
        }

        .background {
            position: relative;
            width: 100%;
            height: 100%;
            /* background-image: url('{{ asset('image/iteralab.png') }}'); */
            background-size: cover;
            background-position: center;
        }

        .background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-color: rgba(0, 0, 0, 0.5); */
            z-index: -1;
        }
    </style>
</head>

<body class="background">
    <nav class="fixed top-0 left-0 z-10 w-full bg-white border-gray-200 shadow-lg dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
            <a href="{{ route('mahasiswa') }}" class="flex flex-col items-center space-x-3 rtl:space-x-reverse">
                <span
                    class="self-center text-2xl font-semibold text-green-500 md:text-1xl whitespace-nowrap">SILK</span>
                <span class="self-center hidden text-xs font-semibold text-green-500 md:block whitespace-nowrap">Sistem
                    Informasi Kesehatan</span>
            </a>
            <div class="flex items-center space-x-1 md:order-2 md:space-x-0 rtl:space-x-reverse">
                @if (Route::has('login'))
                    @auth
                        <button type="button" data-dropdown-toggle="dropdown-menu"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 rounded-lg cursor-pointer dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            {{ Auth::user()->nama }}
                        </button>
                        <!-- Dropdown -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700"
                            id="dropdown-menu">
                            <ul class="py-2 font-medium" role="none">

                                <li>
                                    <a href="{{ route('logout') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">
                                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 rounded-lg cursor-pointer dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            Login
                        </a>
                    @endauth
                @endif

            </div>
        </div>
    </nav>
    <div>
        {{-- @yield('content') --}}
        <div class="max-w-screen-xl p-6 mx-auto mt-14">
            <div class="mt-4">
                <div class="p-4 mt-4 bg-white border rounded-lg shadow-lg">

                    <nav class="bg-white dark:bg-gray-700">
                        <div class="max-w-screen-xl px-4 py-3 mx-auto">
                            <div class="flex items-center">
                                <ul class="flex flex-row mt-0 space-x-8 text-sm font-medium rtl:space-x-reverse">
                                    <li>
                                        <a href="{{ route('profile') }}" class="block text-grey-600  {{Request::is('profile') ? 'text-green-500' : '' }}">Data Diri</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('view-ubah-kata-sandi') }}" class="block text-gray-600 {{Request::is('view-ubah-kata-sandi') ? 'text-green-500' : '' }}">Ubah Kata Sandi</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </nav>

                    {{-- <div class="flex">
                        <!-- Sidebar -->
                        <aside class="w-64 h-screen bg-white shadow-md">
                            <div class="p-4">
                                <nav class="space-y-4">
                                    <h2 class="font-semibold text-gray-600">PROFIL</h2>
                                    <a href="{{ route('profile') }}" class="block text-grey-600  {{Request::is('profile') ? 'text-green-500' : '' }}">Data Diri</a>
                                    <a href="{{ route('view-ubah-kata-sandi') }}" class="block text-gray-600 {{Request::is('view-ubah-kata-sandi') ? 'text-green-500' : '' }}">Ubah Kata Sandi</a>
                                </nav>
                            </div>
                        </aside>

                    </div> --}}
                    @yield('content-profile')
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

</body>

</html>
