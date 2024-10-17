<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Kategori
                </th>
                <th scope="col" class="px-6 py-3">
                    Kondisi
                </th>
                <th scope="col" class="px-6 py-3">
                    Stock
                </th>
                <th scope="col" class="px-6 py-3">
                    Satuan
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
                        {{ $data->nama_barang }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->kategori->kategori }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        @if ($data->stock->stock == 0)
                            <p class="p-1 text-white bg-red-500 rounded-lg">Habis</p>
                        @elseif ($data->stock->stock > 0 && $data->is_stock_reduced)
                            <p class="p-1 text-white bg-yellow-500 rounded-lg">Terpakai</p>
                        @elseif ($data->stock->stock > 0 && $data->is_stock_lost)
                            <p class="p-1 text-white bg-gray-500 rounded-lg">Hilang</p>
                        @else
                            <p class="p-1 text-white bg-green-500 rounded-lg">Baik</p>
                        @endif
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->stock->stock }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->satuan->satuan }}
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
                                action="{{ route('data-barang.hapus', $data->id) }}" method="POST">
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

                {{-- MODAL DETAIL BARANG --}}
                <div id="detail{{ $data->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full p-4">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Detail Barang
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
                            <div class="p-4">
                                <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                                    <!-- Image -->
                                    <div class="flex justify-center mb-3">
                                        <img src="{{ asset($data->foto) }}" alt="{{ $data->foto }}"
                                            class="object-cover border rounded-lg">
                                    </div>
                                    <div>
                                        <div class="text-lg font-semibold">{{ $data->nama_barang }}</div>
                                        <div>
                                            Kategori: {{ $data->kategori->kategori }}
                                        </div>
                                        <div>
                                            Satuan: {{ $data->satuan->satuan }}
                                        </div>
                                        <div>
                                            Kondisi: {{ $data->kondisi->kondisi }}
                                        </div>
                                        <div>
                                            Stock: {{ $data->stock->stock }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL EDIT BARANG --}}
                <div id="edit{{ $data->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full p-4">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit Barang
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
                                <form action="{{ route('data-barang.edit', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-2 gap-2">
                                        <!-- Nama Barang -->
                                        <div class="mb-2">
                                            <label for="nama_barang"
                                                class="block text-sm font-medium text-gray-700">Nama
                                                Barang</label>
                                            <input type="text" name="nama_barang" id="nama_barang"
                                                value="{{ $data->nama_barang }}"
                                                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        </div>

                                        <!-- Stock -->
                                        <div class="mb-2">
                                            <label for="stock"
                                                class="block text-sm font-medium text-gray-700">Stock
                                                Barang</label>
                                            <input type="text" name="stock" id="stock"
                                                value="{{ $data->stock->stock }}"
                                                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        </div>

                                        <!-- Kategori -->
                                        <div class="mb-2">
                                            <label for="kategori_id"
                                                class="block text-sm font-medium text-gray-700">Kategori</label>
                                            <select name="kategori_id" id="kategori_id"
                                                class="block w-full px-3 py-2 mt-1 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                <!-- Assuming you load categories from the database -->
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}"
                                                        {{ $kategori->id == $data->kategori_id ? 'selected' : '' }}>
                                                        {{ $kategori->kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Satuan -->
                                        <div class="mb-2">
                                            <div>
                                                <label for="satuan_id"
                                                    class="block text-sm font-medium text-gray-700">Satuan</label>
                                                <select name="satuan_id" id="satuan_id"
                                                    class="block w-full px-3 py-2 mt-1 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                    <!-- Assuming you load satuans from the database -->
                                                    @foreach ($satuans as $satuan)
                                                        <option value="{{ $satuan->id }}">
                                                            {{ $satuan->satuan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('satuan_id')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- Gambar -->
                                    <div class="mb-2">
                                        <label for="foto"
                                            class="block text-sm font-medium text-gray-700">Gambar</label>
                                        <input type="file" name="foto" id="foto"
                                            value="{{ $data->foto }}"
                                            class="block w-full px-3 mt-1 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
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
