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
                        <h3 class="text-2xl text-green-500 font-semibold">Data Barang</h3>
                    </div>
                    <div>
                        <button data-modal-target="barang" data-modal-toggle="barang"
                            class="bg-green-500 hover:bg-green-800 text-white py-2 px-3 rounded">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                        {{-- MODAL TAMBAH BARANG --}}
                        <div id="barang" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Tambah Barang
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

                                    <form action="{{ route('admin.barang.proses') }}" class="p-4 md:p-5" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-2">
                                            <!-- Nama Barang -->
                                            <div class="mb-2">
                                                <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                                    Barang</label>
                                                <input type="text" name="name" id="name"
                                                    class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            </div>

                                            <!-- Stock -->
                                            <div class="mb-2">
                                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock
                                                    Barang</label>
                                                <input type="text" name="stock" id="stock"
                                                    class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            </div>

                                            <!-- Kategori -->
                                            <div class="mb-2">
                                                <label for="kategori_id"
                                                    class="block text-sm font-medium text-gray-700">Kategori</label>
                                                <select name="kategori_id" id="kategori_id"
                                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                    <!-- Assuming you load categories from the database -->
                                                    @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kategori_id')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Satuan -->
                                            <div class="mb-2">
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div>
                                                        <label for="persentase"
                                                            class="block text-sm font-medium text-gray-700">Persentase</label>
                                                        <input type="number" name="persentase" id="persentase"
                                                            class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                        </input>
                                                    </div>
                                                    <div>
                                                        <label for="satuan_id"
                                                            class="block text-sm font-medium text-gray-700">Satuan</label>
                                                        <select name="satuan_id" id="satuan_id"
                                                            class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                            <!-- Assuming you load satuans from the database -->
                                                            @foreach ($satuans as $satuan)
                                                                <option value="{{ $satuan->id }}">{{ $satuan->satuan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @error('satuan_id')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Room -->
                                            <div class="mb-2">
                                                <label for="room_id"
                                                    class="block text-sm font-medium text-gray-700">Ruangan</label>
                                                <select name="room_id" id="room_id"
                                                    class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                    <!-- Assuming you load rooms from the database -->
                                                    @foreach ($rooms as $room)
                                                        <option value="{{ $room->id }}">{{ $room->ruangan }}</option>
                                                    @endforeach
                                                </select>
                                                @error('room_id')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Gambar -->
                                            <div class="mb-2">
                                                <label for="gambar"
                                                    class="block text-sm font-medium text-gray-700">Gambar</label>
                                                <input type="file" name="gambar" id="gambar"
                                                    class="mt-1 block w-full px-3 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('gambar')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Deskripsi -->
                                        <div class="mb-2">
                                            <label for="deskripsi"
                                                class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                                class="mt-1 block w-full px-3 py-2 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"></textarea>
                                            @error('deskripsi')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="text-white bg-green-500 mt-4 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-lg shadow-lg bg-white">
                <form action="{{ route('admin.barang') }}" method="GET" class="flex flex-col md:flex-row items-center gap-2 mb-4 mt-2">
                    <!-- Filter Nama Barang -->
                    <input type="text" name="name" placeholder="Nama Barang" value="{{ request('name') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">

                    <!-- Filter Kategori -->
                    <select name="kategori_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->kategori }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter Kondisi -->
                    <select name="kondisi"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        <option value="">Pilih Kondisi</option>
                        <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="terpakai" {{ request('kondisi') == 'terpakai' ? 'selected' : '' }}>Terpakai
                        </option>
                        <option value="hilang" {{ request('kondisi') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                        <option value="habis" {{ request('kondisi') == 'habis' ? 'selected' : '' }}>Habis</option>
                    </select>

                    <!-- Filter Stock -->
                    <input type="number" name="stock" placeholder="Minimal Stock" value="{{ request('stock') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">

                    <!-- Filter Satuan -->
                    <select name="satuan_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        <option value="">Pilih Satuan</option>
                        @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->id }}"
                                {{ request('satuan_id') == $satuan->id ? 'selected' : '' }}>
                                {{ $satuan->satuan }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="px-4 py-2 w-full bg-green-500 text-white rounded-lg hover:bg-green-800">Filter</button>
                </form>

                <div id="tableContainer">
                    @include('admin.kelolabarang.table', ['barangs' => $barangs])
                </div>

                <div id="paginationLinks">
                    {{ $barangs->links() }}
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Apply filter ketika button filter di klik
            $('#applyFilter').on('click', function(e) {
                e.preventDefault();
                loadTable();
            });

            // Handle pagination link click event
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadTable(page);
            });

            function loadTable(page = 1) {
                $.ajax({
                    url: "{{ route('admin.barang') }}",
                    method: "GET",
                    data: {
                        name: $('#filterName').val(),
                        kategori_id: $('#filterKategori').val(),
                        kondisi: $('#filterKondisi').val(),
                        stock: $('#filterStock').val(),
                        satuan_id: $('#filterSatuan').val(),
                        page: page
                    },
                    success: function(response) {
                        // Replace table and pagination links
                        $('#tableContainer').html($(response).find('#tableContainer').html());
                        $('#paginationLinks').html($(response).find('#paginationLinks').html());
                    }
                });
            }
        });
    </script>
@endsection
