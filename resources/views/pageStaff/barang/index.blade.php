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
                        <h3 class="text-2xl font-semibold text-green-500">Data Barang</h3>
                    </div>
                    <div>
                        <button data-modal-target="import-barang" data-modal-toggle="import-barang"
                            data-tooltip-target="import" data-tooltip-placement="left"
                            class="justify-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800">
                            <i class="fa-solid fa-file-arrow-up"></i>
                        </button>

                        <div id="import" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Import
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>

                        {{-- MODAL IMPORT BARANG --}}
                        @include('pageStaff.barang.modal.import')

                        <button data-modal-target="tambah-barang" data-modal-toggle="tambah-barang"
                            class="justify-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        {{-- MODAL TAMBAH BARANG --}}
                        @include('pageStaff.barang.modal.tambah')
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div id="data-barang-container">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-gray-500 dark:text-gray-400 display" id="data-barang">
                            <thead class="uppercase text-cen-gray-700 dark:text-gray-400">
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

                            </tbody>
                        </table>
                    </div>
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
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#data-barang').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('data-barang') }}",
                    data: function(d) {
                        d.nama_barang = $('#filterName').val();
                        d.kategori_id = $('#filterKategori').val();
                        d.kondisi = $('#filterKondisi').val();
                        d.satuan_id = $('#filterSatuan').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'kondisi',
                        name: 'kondisi'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });

            $('#applyFilter').on('click', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });
        });
    </script>
@endsection
