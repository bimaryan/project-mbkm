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
                        <h3 class="text-2xl font-semibold text-green-500">Data Mata Kuliah</h3>
                    </div>
                    <div>
                        <button data-modal-target="barang" data-modal-toggle="barang"
                            class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-800"><i
                                class="fa-solid fa-plus"></i>
                        </button>

                        {{-- MODAL TAMBAH MATA KULIAH --}}
                        <div id="barang" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full p-4">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Tambah Mata Kuliah
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

                                    <form action="{{ route('data-mata-kuliah.proses') }}" class="p-4 md:p-5" method="POST">
                                        @csrf
                                        <div class="gap-2">
                                            <div class="mb-2">
                                                <label for="kode_mata_kuliah"
                                                    class="block text-sm font-medium text-gray-700">kode Mata Kuliah</label>
                                                <input type="text" name="kode_mata_kuliah" id="kode_mata_kuliah" placeholder="Masukan Kode Mata Kuliah"
                                                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                @error('kode_mata_kuliah')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="mata_kuliah"
                                                    class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                                                <input type="text" name="mata_kuliah" id="mata_kuliah" placeholder="Masukan Nama Mata Kuliah"
                                                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                @error('mata_kuliah')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
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
                <form action="">

                </form>
                <div id="tableMatakuliah">
                    @include('admin.matakuliah.table', ['matakuliah' => $matakuliah])
                </div>

                <div id="pageignitionLinks">
                    {{ $matakuliah->links() }}
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
                    url: "{{ route('data-mata-kuliah') }}",
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
                        $('#tableMatakuliah').html($(response).find('#tableMatakuliah').html());
                        $('#paginationLinks').html($(response).find('#paginationLinks').html());
                    }
                });
            }
        });
        $(document).ready(function() {
            $('#data-mata-kuliah').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: '300px'
            });
        });
    </script>
@endsection
