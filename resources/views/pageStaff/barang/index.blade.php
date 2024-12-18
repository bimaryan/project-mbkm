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
                            class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-800">
                            <i class="fa-solid fa-upload"></i>
                        </button>
                        {{-- MODAL IMPORT BARANG --}}
                        @include('pageStaff.barang.modal.import')

                        <button data-modal-target="tambah-barang" data-modal-toggle="tambah-barang"
                            class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-800">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        {{-- MODAL TAMBAH BARANG --}}
                        @include('pageStaff.barang.modal.tambah')
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">

                <div id="tableBarang">
                    @include('pageStaff.barang.table', ['barangs' => $barangs])
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

            function loadTable() {
                $.ajax({
                    url: "{{ route('data-barang') }}",
                    method: "GET",
                    data: {
                        name: $('#filterName').val(),
                        kategori_id: $('#filterKategori').val(),
                        kondisi: $('#filterKondisi').val(),
                        stock: $('#filterStock').val(),
                        satuan_id: $('#filterSatuan').val(),
                    },
                    success: function(response) {
                        // Replace table and pagination links
                        $('#tableBarang').html($(response).find('#tableBarang').html());
                    }
                });
            }
        });
        $(document).ready(function() {
            $('#data-barang').DataTable({
                paging: true,
                pageLength: 5,
                scrollCollapse: true,
                scrollY: '300px',
                language: {
                    paginate: {
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    },
                    lengthMenu: 'Tampilkan _MENU_ data per halaman',
                    info: 'Menampilkan _START_ hingga _END_ dari _TOTAL_ data',
                    search: 'Cari:',
                }
            });
        });
    </script>
@endsection
