<nav class="fixed top-0 z-50 w-full bg-gray-100 shadow dark:text-white dark:bg-gray-900">
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
                    <span
                        class="self-center text-2xl font-semibold text-green-500 md:text-1xl whitespace-nowrap">SILK</span>
                    <span
                        class="self-center hidden text-xs font-semibold text-green-500 md:block whitespace-nowrap">Sistem
                        Informasi Kesehatan</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex items-center gap-2">
                        <div class="hidden md:block">
                            <div class="flex-col text-right md:flex">
                                <p class="text-sm">{{ Auth::user()->nama }}</p>
                                <p class="text-xs">
                                    {{ Auth::user()->role->nama ? Auth::user()->role->nama : 'No Role Assigned' }}
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
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('dashboard') ? 'bg-green-500 text-white' : '' }}">
                    <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-house"></i> Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role->nama === 'Admin')
                <li>
                    <a id="kelolausers" data-collapse-toggle="users" aria-controls="kelolausers"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/kelola-users/*') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-users"></i> Pengguna</span> <i
                            class="fa-solid fa-chevron-down"></i>
                    </a>

                    <ul id="users" class="hidden py-2 space-y-2" aria-labelledby="kelolausers">
                        <li>
                            <a href="{{ route('data-admin-dan-staff') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/kelola-users/users') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-user me-2"></i>Admin dan Staff</a>
                        </li>
                        <li>
                            <a href="{{ route('data-mahasiswa') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/kelola-users/users/create') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-user me-2"></i>Mahasiswa</a>
                        </li>
                        <li>
                            <a href="{{ route('data-kelas') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/kelola-users/users/create') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-user me-2"></i>Data Kelas</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role->nama === 'Staff' || Auth::user()->role->nama === 'Admin')
                <li>
                    <a id="kelolaproduk" data-collapse-toggle="dropdown"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/alat-dan-bahan/*') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-folder"></i> Alat dan
                            Bahan</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>

                    <ul id="dropdown" class="hidden py-2 space-y-2" aria-labelledby="kelolaproduk">
                        <li>
                            <a href="{{ route('data-barang') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/alat-dan-bahan/barang') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Barang</a>
                        </li>
                        <li>
                            <a href="{{ route('data-kategori') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/alat-dan-bahan/kategori') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Kategori</a>
                        </li>
                        <li>
                            <a href="{{ route('data-satuan') }}"
                                class="flex gap-1 items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/alat-dan-bahan/satuan') ? 'bg-gray-300' : '' }}"><i
                                    class="fa-solid fa-folder-open"></i> Data
                                Satuan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('verifikasi') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/verifikasi-peminjaman') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="fa-solid fa-square-check"></i>
                            Verifikasi Peminjaman</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
