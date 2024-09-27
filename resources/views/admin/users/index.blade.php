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

            <!-- Breadcrumb Navigation -->
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
                            <a class="active text-sm font-medium text-gray-500 dark:text-gray-400">Daftar Pengguna</a>
                        </div>
                    </li>
                </ol>
            </div>

            <!-- Table & Add Button -->
            <div class="p-4 rounded-lg shadow-lg bg-white">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-2xl font-medium">Daftar Mahasiswa</h3>
                    </div>
                    <div>
                        <button id="openModalBtn" 
                            class="bg-green-500 hover:bg-green-800 text-white py-2 px-4 rounded">
                            Tambah
                        </button>
                    </div>
                </div>

                <div class="relative overflow-x-auto sm:rounded-lg mt-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-3">NIM</th>
                                <th scope="col" class="px-6 py-3">Kelas</th>
                                <th scope="col" class="px-6 py-3">Program Studi</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $data)
                                <tr class="bg-white dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $data->nama_lengkap }}</td>
                                    <td class="px-6 py-4">{{ $data->name }}</td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4">{{ $data->keterangan }}</td>
                                    <td class="px-3 py-10 text-center">
                                        <button type="button" class="text-white bg-yellow-300 hover:bg-yellow-500 py-2 px-5 rounded">Detail</button>
                                        <button type="button" class="text-white bg-red-600 hover:bg-red-800 py-2 px-5 rounded">Hapus</button>
                                        <button type="button" class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-5 rounded">Ubah</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="addModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-lg hidden transition-all ease-in-out duration-300">
        <div class="bg-white rounded-lg shadow-xl p-6 w-1/2 top-20 transform transition-transform duration-300 ease-in-out scale-95">
            <h3 class="text-2xl font-medium mb-4">Tambah Pengguna</h3>
            <form action="{{ route('admin.users.proses') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap"
                        class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                    <input type="text" name="telepon" id="telepon"
                        class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                    <select name="role_id" id="role_id"
                        class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        <option value="">Pilih Role</option>
                        <option value="{{ \App\Models\Role::DOSEN }}">Dosen</option>
                        <option value="{{ \App\Models\Role::MAHASISWA }}">Mahasiswa</option>
                    </select>
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan"
                        class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"></textarea>
                </div>

                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-800 focus:outline-none">
                        Simpan
                    </button>
                    <button type="button" id="closeModalBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-700 focus:outline-none">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        document.getElementById('openModalBtn').addEventListener('click', function () {
            const modal = document.getElementById('addModal');
            modal.classList.remove('hidden');
            modal.classList.add('opacity-100', 'scale-100');
        });

        document.getElementById('closeModalBtn').addEventListener('click', function () {
            const modal = document.getElementById('addModal');
            modal.classList.add('hidden');
            modal.classList.remove('opacity-100', 'scale-100');
        });
    </script>
@endsection
