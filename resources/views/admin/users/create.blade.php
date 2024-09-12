@extends('index')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="rounded-lg mt-14 space-y-4">
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a class="inline-flex items-center text-gray-700 dark:text-white text-sm font-medium">
                            Main
                        </a>
                    </li>
                    <span class="mx-2 text-gray-500">/</span>
                    <li>
                        <div class="flex items-center">
                            <a class="active text-sm font-medium text-gray-500 dark:text-gray-400">Kelola Pengguna</a>
                        </div>
                    </li>
                    <span class="mx-2 text-gray-500">/</span>
                    <li>
                        <div class="flex items-center">
                            <a class="text-sm font-medium text-gray-500 dark:text-gray-400">Tambah Pengguna</a>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="p-4 rounded-lg shadow-lg bg-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-medium">Tambah Pengguna</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.users') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
                <div>
                    <form action="{{ route('admin.users.proses') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="name" id="name"
                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('name')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="text" name="email" id="email"
                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('email')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password"
                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('password')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="role_id" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                                <select name="role_id" id="role_id"
                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">Pilih Role</option>
                                    <option value="{{ \App\Models\Role::STAFF }}">Staff</option>
                                    <option value="{{ \App\Models\Role::MAHASISWA }}">Mahasiswa</option>
                                </select>
                                @error('role_id')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
