<nav class="fixed top-0 left-0 z-10 w-full bg-white border-gray-200 shadow-lg dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
        <a href="{{ route('home') }}" class="flex flex-col items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('logo/silk-transparant.png') }}" class="hidden w-24 md:block"
                alt="{{ asset('logo/silk.png') }}" />
            <img src="{{ asset('logo/polindra.png') }}" class="w-10 md:hidden" alt="{{ asset('logo/polindra.png') }}" />
        </a>
        <div class="flex items-center space-x-1 md:order-2 md:space-x-0 rtl:space-x-reverse">
            @if (Route::has('login'))
                @auth
                    <button type="button" data-dropdown-toggle="dropdown-menu"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 rounded-lg cursor-pointer dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        {{ Auth::user()->nama }}
                    </button>
                    <!-- Dropdown -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
                        id="dropdown-menu">
                        <ul class="py-2 font-medium" role="none">
                            <li>
                                <a href="{{ route('profile') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white {{ Route::is('profile') ? 'bg-gray-200' : '' }}"
                                    role="menuitem">
                                    <i class="fa-solid fa-user me-3"></i>Profil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">
                                    <i class="fa-solid fa-right-from-bracket me-3"></i>Keluar
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
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-3 rounded md:bg-transparent md:p-0
           {{ Route::is('home') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('katalog') }}"
                        class="block py-2 px-3 rounded md:border-0 md:p-0
           {{ Route::is('katalog') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Katalog</a>
                </li>
                <li>
                    <a href="{{ route('keranjang') }}"
                        class="block py-2 px-3 rounded md:border-0 md:p-0
           {{ Route::is('keranjang') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Peminjaman</a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.informasi') }}"
                        class="block py-2 px-3 rounded md:border-0 md:p-0
           {{ Route::is('mahasiswa.informasi') ? 'text-white bg-green-700 md:text-green-700 md:bg-transparent' : 'text-gray-900 md:hover:text-green-700 dark:text-white dark:hover:bg-gray-700' }}">Informasi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
