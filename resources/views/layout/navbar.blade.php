<nav class="fixed top-0 z-50 w-full dark:text-white bg-gray-100 shadow dark:bg-gray-900">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
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
                <a class="flex ms-2 md:me-24">
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-gray-100 text-gray-900">PROJECT MBKM</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex items-center gap-2">
                        <div class="hidden md:block">
                            @can('admin')
                                <div class="md:flex flex-col text-right">
                                    <p class="text-sm">{{ Auth::user()->email }}</p>
                                    <p class="text-xs">
                                        {{ Auth::user()->getAkses ? Auth::user()->getAkses->name : 'No Role Assigned' }}</p>
                                </div>
                            @endcan
                            @can('staff')
                                <div class="md:flex flex-col text-right">
                                    <p class="text-sm">{{ Auth::user()->email }}</p>
                                    <p class="text-xs">
                                        {{ Auth::user()->getAkses ? Auth::user()->getAkses->name : 'No Role Assigned' }}</p>
                                </div>
                            @endcan
                            @can('mahasiswa')
                                <div class="md:flex flex-col text-right">
                                    <p class="text-sm">{{ Auth::user()->email }}</p>
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
                                    role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<aside id="logo-sidebar"
    class="fixed top-0 shadow-lg left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0 bg-gray-100 dark:bg-gray-900"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-1 font-medium">
            @can('admin')
                <li>
                    <span class="text-sm text-gray-900 dark:text-gray-100">Main</span>
                    <a href=""
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/dashboard') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="bi bi-house-door"></i> Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('admin/users') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="bi bi-people"></i> List Users</span>
                    </a>
                </li>
            @endcan
            @can('dokter')
                <li>
                    <span class="text-sm text-gray-900 dark:text-gray-100">Main</span>
                    <a href=""
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('beranda/dashboard/band/index.html') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="bi bi-house-door"></i> Dashboard</span>
                    </a>
                </li>
            @endcan
            @can('pegawai')
                <li>
                    <span class="text-sm text-gray-900 dark:text-gray-100">Main</span>
                    <a href="{{ route('cafe.dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-gray-100 hover:bg-green-800 hover:text-white group  {{ Request::is('beranda/dashboard/cafe/index.html') ? 'bg-green-500 text-white' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap"><i class="bi bi-house-door"></i> Dashboard</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</aside>
