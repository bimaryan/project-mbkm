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
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Data Pengguna</h3>
                    <button data-modal-target="barang" data-modal-toggle="barang"
                        class="bg-green-500 hover:bg-green-800 text-white py-2 px-3 rounded"> Tambah
                        <i class="bi bi-plus-square"></i>
                    </button>
                </div>

                {{-- MODAL TAMBAH PENGGUNA --}}
                <div id="barang" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Tambah Data Pengguna
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="barang">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->

                            <form action="{{ route('admin.users.proses') }}" class="p-4 md:p-5" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <div class="mb-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                                        <input type="text" name="name" id="name"
                                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        @error('name')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        @error('nama_lengkap')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        @error('password')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                                        <input type="text" name="telepon" id="telepon"
                                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        @error('telepon')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="role_id" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                                        <select name="role_id" id="role_id"
                                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            <option value="">Pilih Role</option>
                                            <option value="{{ \App\Models\Role::DOSEN }}">Dosen</option>
                                            <option value="{{ \App\Models\Role::MAHASISWA }}">Mahasiswa</option>
                                        </select>
                                        @error('role_id')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2 col-span-full">
                                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" rows="3"
                                            class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"></textarea>
                                        @error('keterangan')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <table class="table-auto w-full text-left mt-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2">No</th>
                            <th class="p-2">Username</th>
                            <th class="p-2">Nama Lengkap</th>
                            <th class="p-2">Role</th>
                            <th class="p-2">Telepon</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $key => $item)
                            <tr class="border-b">
                                <td class="p-2">{{ $key + 1 }}</td>
                                <td class="p-2">{{ $item->name }}</td>
                                <td class="p-2">{{ $item->nama_lengkap }}</td>
                                <td class="p-2">{{ optional($item->role)->name }}</td>
                                <td class="p-2">{{ $item->telepon }}</td>
                                <td class="p-2">
                                    <a href="{{ route('admin.users.edit', $item->id) }}"
                                        class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('admin.users.delete', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
