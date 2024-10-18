<nav class="fixed top-0 z-50 w-full bg-gray-50 shadow dark:text-white dark:bg-gray-900">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start gap-2 rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a class="flex flex-col items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('logo/silk.png') }}" class="h-14 hidden md:block"
                        alt="{{ asset('logo/silk.png') }}" />
                    <img src="{{ asset('logo/polindra.png') }}" class="h-10 md:hidden"
                        alt="{{ asset('logo/polindra.png') }}" />
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex items-center gap-4">
                        <div>
                            <button type="button" class="relative inline-flex items-center text-2xl"
                                data-dropdown-toggle="dropdown-notifikasi">
                                <i class="fa-regular fa-bell"></i>
                                <span class="sr-only">Notifications</span>
                                <div
                                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                                    20</div>
                            </button>

                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-notifikasi">
                                <ul class="py-1" role="none">
                                    <li>
                                        <p class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">
                                            Notifikasi Peminjaman
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="flex-col text-right md:flex">
                                <p class="text-sm">{{ Auth::user()->nama }}</p>
                                <p class="text-xs">
                                    {{ Auth::user()->role->nama_role ? Auth::user()->role->nama_role : 'No Role Assigned' }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Keluar <i class="fa-solid fa-right-from-bracket"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 mt-3 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Route::is('dashboard') ? 'bg-green-500 text-white' : '' }}">
                    <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-house me-2"></i>Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role->nama_role === 'Admin')
                <li>
                    <a id="pengguna" data-collapse-toggle="users" aria-controls="pengguna"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('pengguna/*') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap">
                            <i class="fa-solid fa-users me-2"></i>Pengguna</span><i
                            class="fa-solid fa-chevron-down"></i>
                    </a>
                    <ul id="users" class="hidden py-2 space-y-2" aria-labelledby="pengguna">
                        <li>
                            <a href="{{ route('data-admin-dan-staff') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Route::is('data-admin-dan-staff') ? 'bg-gray-300' : '' }}">
                                <i class="fa-solid fa-user me-2"></i>Admin dan Staff
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-mahasiswa') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Route::is('data-mahasiswa') ? 'bg-gray-300' : '' }}">
                                <i class="fa-solid fa-user me-2"></i>Mahasiswa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-dosen') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Route::is('data-dosen') ? 'bg-gray-300' : '' }}">
                                <i class="fa-solid fa-user me-2"></i>Dosen
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('data-kelas') }}"
                        class="mt-2 flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Route::is('data-kelas') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i
                                class="fa-solid fa-landmark me-2"></i>Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data-mata-kuliah') }}"
                        class="mt-2 flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Route::is('data-mata-kuliah') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-regular fa-file-lines me-2"></i>Mata
                            Kuliah</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role->nama_role === 'Staff')
                <li>
                    <a id="kelolaproduk" data-collapse-toggle="dropdown"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('data-alat-dan-bahan/*') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-folder"></i> Alat dan
                            Bahan</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>

                    <ul id="dropdown" class="hidden py-2 space-y-2" aria-labelledby="kelolaproduk">
                        <li>
                            <a href="{{ route('data-barang') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Route::is('data-barang') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Barang</a>
                        </li>
                        <li>
                            <a href="{{ route('data-kategori') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Route::is('data-kategori') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Kategori</a>
                        </li>
                        <li>
                            <a href="{{ route('data-satuan') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Route::is('data-satuan') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Satuan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('verifikasi') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Route::is('verifikasi') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-square-check"></i>
                            Verifikasi Peminjaman</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
