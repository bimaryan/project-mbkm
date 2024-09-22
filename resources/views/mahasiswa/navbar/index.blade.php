<nav class="fixed top-0 left-0 z-10 w-full bg-white border-gray-200 dark:bg-gray-900 shadow-lg">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('mahasiswa') }}" class="flex flex-col items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center md:text-1xl text-2xl font-semibold whitespace-nowrap text-green-500">SILK</span>
            <span class="self-center hidden md:block text-xs font-semibold whitespace-nowrap text-green-500">Sistem
                Informasi Kesehatan</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('mahasiswa') }}"
                        class="block py-2 px-3 rounded md:bg-transparent md:p-0
           {{ Route::is('mahasiswa') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.katalog') }}"
                        class="block py-2 px-3 rounded md:border-0 md:p-0
           {{ Route::is('mahasiswa.katalog') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Katalog</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 rounded md:border-0 md:p-0
           {{ Route::is('mahasiswa.viewbarang') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Peminjaman</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 rounded md:border-0 md:p-0
           {{ Route::is('informasi') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Informasi</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li>
                            <a href="#"
                                class="block py-2 px-3 rounded md:border-0 md:p-0
                   {{ Route::is('profil') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Profil</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                                class="block py-2 px-3 rounded md:border-0 md:p-0
                   {{ Route::is('login') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Login</a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
