<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-gray-500 dark:text-gray-400 display" style="100%" id="data-mahasiswa">
        <thead class="uppercase text-cen-gray-700 dark:text-gray-400">
            <tr>
                {{-- <th scope="col" class="px-6 py-3"> --}}
                <th scope="col" class="px-6 py-3 ">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Lengkap
                </th>
                <th scope="col" class="px-6 py-3">
                    NIM
                </th>
                <th scope="col" class="px-6 py-3">
                    Kelas
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $data)
                <tr>
                    <td scope="col" class="px-6 py-3">
                        {{ $loop->iteration }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->nama }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->nim }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->kelas->nama_kelas }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        @if ($data->email)
                            {{ $data->email }}
                        @else
                            -
                        @endif
                    </td>
                    <td scope="col" class="flex items-center justify-center gap-2 px-6 py-3">
                        <div>
                            <button type="button" data-modal-target="detail{{ $data->id }}"
                                data-modal-toggle="detail{{ $data->id }}"
                                class="flex items-center px-2 py-2 text-sm text-white bg-yellow-400 rounded">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <div>
                            <form id="delete-form-{{ $data->id }}"
                                action="{{ route('data-mahasiswa.delete', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $data->id }})"
                                    class="flex items-center px-2 py-2 text-sm text-white bg-red-500 rounded">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div>
                            <button type="button" data-modal-target="edit{{ $data->id }}"
                                data-modal-toggle="edit{{ $data->id }}"
                                class="flex items-center px-2 py-2 text-sm text-white bg-blue-500 rounded">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                {{-- MODAL DETAIL MAHASISWA --}}
                <div id="detail{{ $data->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full p-4">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Detail Mahasiswa
                                </h3>
                                <button type="button"
                                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="detail{{ $data->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-2">
                                <div class="flex flex-col items-center gap-5 p-4 md:flex-row">
                                    <div class="relative overflow-hidden border border-green-500">
                                        <img src="{{ asset($data->foto) }}" alt="{{ $data->foto }}"
                                            class="object-cover" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="space-y-2">
                                            <p
                                                class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                                <span>NIM</span>
                                                <span>:</span>
                                            </p>
                                            <p
                                                class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                                <span>Nama</span>
                                                <span>:</span>
                                            </p>
                                            <p
                                                class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                                <span>Kelas</span>
                                                <span>:</span>
                                            </p>
                                            <p
                                                class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                                <span>Email</span>
                                                <span>:</span>
                                            </p>
                                            <p
                                                class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                                <span>Nomor Telepon</span>
                                                <span>:</span>
                                            </p>
                                            <p
                                                class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                                                <span>Jenis Kelamin</span>
                                                <span>:</span>
                                            </p>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $data->nim }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $data->nama }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $data->kelas->nama_kelas }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $data->email }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $data->telepon }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $data->jenis_kelamin }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL EDIT MAHASISWA --}}
                <div id="edit{{ $data->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full p-4">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit Mahasiswa
                                </h3>
                                <button type="button"
                                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="edit{{ $data->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4">
                                <form action="{{ route('data-mahasiswa.edit', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="gap-2">
                                        <div class="mb-2">
                                            <label for="nama"
                                                class="block text-sm font-medium text-gray-700">Nama</label>
                                            <input type="text" name="nama" id="nama"
                                                value="{{ $data->nama }}"
                                                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            @error('nama')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="nim"
                                                class="block text-sm font-medium text-gray-700">NIM</label>
                                            <input type="number" name="nim" id="nim"
                                                value="{{ $data->nim }}"
                                                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            @error('nim')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="kelas_id"
                                                class="block text-sm font-medium text-gray-700">Pilih
                                                Kelas</label>
                                            <select name="kelas_id" id="kelas_id"
                                                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                <option value="{{ $data->kelas_id }}">{{ $data->kelas->nama_kelas }}
                                                </option>
                                            </select>
                                            @error('kelas_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button type="submit"
                                            class="text-white bg-green-500 mt-4 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
