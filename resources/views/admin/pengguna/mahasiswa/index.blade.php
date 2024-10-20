@extends('index')
@section('content')
    <div class="p-4 mt-3 sm:ml-64">
        <div class="space-y-4 rounded-lg mt-14">
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
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold text-green-500">Data Mahasiswa</h3>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <button class="justify-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800"
                                data-modal-target="import-mahasiswa" data-modal-toggle="import-mahasiswa"><i
                                    class="fa-solid fa-file-import"></i>
                            </button>

                            <div id="import-mahasiswa" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Import Mahasiswa
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="import-mahasiswa">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form action="{{ route('import.mahasiswa') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div>
                                                    <label for="file"
                                                        class="block text-sm font-medium text-gray-700">Import</label>
                                                    <input type="file" name="file" id="file"
                                                        class="block border w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                    @error('file')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <button type="submit"
                                                    class="text-white bg-green-500 mt-4 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button data-modal-target="barang" data-modal-toggle="barang"
                                class="justify-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>

                        {{-- MODAL TAMBAH MAHASISWA --}}
                        <div id="barang" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full p-4">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Tambah Mahasiswa
                                        </h3>
                                        <button type="button"
                                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
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

                                    <form action="{{ route('data-mahasiswa.proses') }}" class="p-4 md:p-5" method="POST">
                                        @csrf
                                        <div class="gap-2">
                                            <div class="mb-2">
                                                <label for="nama"
                                                    class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input type="text" name="nama" id="nama"
                                                    placeholder="Masukan Nama Lengkap"
                                                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                @error('nama')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="nim"
                                                    class="block text-sm font-medium text-gray-700">NIM</label>
                                                <input type="number" name="nim" id="nim"
                                                    placeholder="Masukan NIM"
                                                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                @error('nip')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Pilih
                                                    Kelas</label>
                                                <select name="kelas_id" id="kelas_id"
                                                    class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                                    <option value="">- Pilih Kelas -</option>
                                                    @foreach ($kelas as $kelas)
                                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kelas_id')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <!-- Gambar -->
                                            {{-- <div class="mb-2">
                                                <label for="foto"
                                                    class="block text-sm font-medium text-gray-700">Foto</label>
                                                <input type="file" name="foto" id="foto"
                                                    class="block w-full px-3 mt-1 border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('foto')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div> --}}

                                        </div>
                                        <button type="submit"
                                            class="text-white bg-green-500 mt-4 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">

                <div id="tableMahasiswa">
                    @include('admin.pengguna.mahasiswa.table', ['mahasiswa' => $mahasiswa])
                </div>

                <div id="pageignitionLinks">
                    {{ $mahasiswa->links() }}
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
                    url: "{{ route('data-mahasiswa') }}",
                    method: "GET",
                    data: {
                        // name: $('#filterName').val(),
                        // kategori_id: $('#filterKategori').val(),
                        // kondisi: $('#filterKondisi').val(),
                        // stock: $('#filterStock').val(),
                        // satuan_id: $('#filterSatuan').val(),
                        // page: page
                    },
                    success: function(response) {
                        // Replace table and pagination links
                        $('#tableMahasiswa').html($(response).find('#tableMahasiswa').html());
                        $('#paginationLinks').html($(response).find('#paginationLinks').html());
                    }
                });
            }
        });
        $(document).ready(function() {
            $('#data-mahasiswa').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: '300px'
            });
        });
    </script>
@endsection
