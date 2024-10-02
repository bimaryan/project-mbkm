<nav class="fixed top-0 z-50 w-full dark:text-white bg-gray-100 shadow dark:bg-gray-900">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex gap-2 items-center justify-start rtl:justify-end">
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
                    <span
                        class="self-center md:text-1xl text-2xl font-semibold whitespace-nowrap text-green-500">SILK</span>
                    <span
                        class="self-center hidden md:block text-xs font-semibold whitespace-nowrap text-green-500">Sistem
                        Informasi Kesehatan</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex items-center gap-2">
                        <div class="hidden md:block">
                            @can('admin')
                                <div class="md:flex flex-col text-right">
                                    <p class="text-sm">{{ Auth::user()->name }}</p>
                                    <p class="text-xs">
                                        {{ Auth::user()->getAkses ? Auth::user()->getAkses->name : 'No Role Assigned' }}</p>
                                </div>
                            @endcan
                            @can('dosen')
                                <div class="md:flex flex-col text-right">
                                    <p class="text-sm">{{ Auth::user()->name }}</p>
                                    <p class="text-xs">
                                        {{ Auth::user()->getAkses ? Auth::user()->getAkses->name : 'No Role Assigned' }}</p>
                                </div>
                            @endcan
                            @can('mahasiswa')
                                <div class="md:flex flex-col text-right">
                                    <p class="text-sm">{{ Auth::user()->name }}</p>
                                    <p class="text-xs">
                                        {{ Auth::user()->getAkses ? Auth::user()->getAkses->name : 'No Role Assigned' }}</p>
                                </div>
                            @endcan
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
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @can('admin')
                <li>
                    <a href="{{ route('admin') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-house"></i> Dashboard</span>
                    </a>
                </li>
                <li>
                    <a id="kelolausers" data-collapse-toggle="users" aria-controls="kelolausers"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/kelola-users/*') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-users"></i> Pengguna</span> <i
                            class="fa-solid fa-chevron-down"></i>
                    </a>

                    <ul id="users" class="hidden py-2 space-y-2" aria-labelledby="kelolausers">
                        <li>
                            <a href="{{ route('admin.users') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/kelola-users/users') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-user"></i> Mahasiswa</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.create') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/kelola-users/users/create') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-user"></i> Dosen
                                dan Staff</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="kelolaproduk" data-collapse-toggle="dropdown"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/alat-dan-bahan/*') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-folder"></i> Alat dan Bahan</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>

                    <ul id="dropdown" class="hidden py-2 space-y-2" aria-labelledby="kelolaproduk">
                        <li>
                            <a href="{{ route('admin.barang') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/alat-dan-bahan/barang') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Barang</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.kategori') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/alat-dan-bahan/kategori') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Kategori</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.satuan') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/alat-dan-bahan/satuan') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Satuan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.peminjaman') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/verifikasi-peminjaman') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-square-check"></i>
                            Verifikasi Peminjaman</span>
                    </a>
                </li>
            @endcan
            @can('dosen')
                <li>
                    <span class="text-sm text-gray-900 dark:text-gray-100">Main</span>
                    <a href=""
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('dosen') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="bi bi-house-door"></i> Dashboard</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</aside>
