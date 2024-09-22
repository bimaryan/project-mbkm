@extends('index')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="rounded-lg mt-14 space-y-4">
            @if (session('success'))
                <script>
                    Swal.fire({
                        title: "Success",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    });
                </script>
            @endif
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
                            <a class="active text-sm font-medium text-gray-500 dark:text-gray-400">Kelola Barang</a>
                        </div>
                    </li>
                    <span class="mx-2 text-gray-500">/</span>
                    <li>
                        <div class="flex items-center">
                            <a class="active text-sm font-medium text-gray-500 dark:text-gray-400">Data Barang</a>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="p-4 rounded-lg shadow-lg bg-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-medium">Data Barang</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.barang.create') }}"
                            class="bg-green-500 hover:bg-green-800 text-white py-2 px-4 rounded">
                            Tambah Barang
                        </a>
                    </div>

                </div>
                <div class="relative overflow-x-auto sm:rounded-lg mt-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kategori Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Posisi Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $data)
                                <tr>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $data->name }}
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $data->stock }}
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $data->kategori->kategori }}
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $data->room->ruangan }}
                                    </td>
                                    <td scope="col" class="px-6 py-3">

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
