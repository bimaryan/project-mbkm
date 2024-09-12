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
                            <a class="active text-sm font-medium text-gray-500 dark:text-gray-400">Kelola Produk</a>
                        </div>
                    </li>
                    <span class="mx-2 text-gray-500">/</span>
                    <li>
                        <div class="flex items-center">
                            <a class="text-sm font-medium text-gray-500 dark:text-gray-400">Tambah Alat Lab</a>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="p-4 rounded-lg shadow-lg bg-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-medium">Tambah Alat Lab</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.alat') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
                <div>
                    <form action="{{ route('admin.alat.proses') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div>
                                <label for="nama_alat" class="block text-sm font-medium text-gray-700">Nama Alat</label>
                                <input type="text" nama_alat="nama_alat" id="nama_alat"
                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('nama_alat')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="text" stock="stock" id="stock"
                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                @error('stock')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
