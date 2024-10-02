@extends('index')
@section('content')
    <div class="p-4 sm:ml-64 mt-3">
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
                    <div>
                        <h3 class="text-lg font-semibold">Data Pengguna</h3>
                    </div>
                    <div>
                        <button data-modal-target="barang" data-modal-toggle="barang"
                            class="bg-green-500 hover:bg-green-800 text-white py-2 px-3 rounded"> Tambah
                            <i class="bi bi-plus-square"></i>
                        </button>

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
                                            <div class="mb-2">
                                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                                <textarea name="keterangan" id="keterangan"
                                                    class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"></textarea>
                                                @error('keterangan')
                                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="text-white bg-green-500 mt-4 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 rounded-lg shadow-lg bg-white">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-3">Username</th>
                                <th scope="col" class="px-6 py-3">Telepon</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3">Keterangan</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $data)
                                <tr class="bg-white dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $data->nama_lengkap }}</td>
                                    <td class="px-6 py-4">{{ $data->name }}</td>
                                    <td class="px-6 py-4">{{ $data->telepon }}</td>
                                    <td class="px-6 py-4">{{ $data->role_id }}</td>
                                    <td class="px-6 py-4">{{ $data->keterangan }}</td>
                                    <td scope="col" class="px-6 py-4 flex justify-center items-center gap-2">
                                        <button type="button" class="text-white bg-yellow-300 hover:bg-yellow-500 py-2 px-3 rounded">
                                            <i class="bi bi-info-circle"></i>
                                        </button>
                                        <form id="delete-form-{{ $data->id }}" action="{{ route('admin.users.delete', $data->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $data->id }})" class="py-2 px-3 bg-red-500 rounded text-sm text-white flex items-center">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-3 rounded">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{$user->links()}}
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
