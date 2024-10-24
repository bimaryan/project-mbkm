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
                        <h3 class="text-2xl font-semibold text-green-500">Mata Kuliah</h3>
                    </div>
                    <div>
                        <button class="justify-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800"
                            data-modal-target="import-matkul" data-modal-toggle="import-matkul"><i
                                class="fa-solid fa-file-import"></i>
                        </button>
                        {{-- MODAL IMPORT DATA --}}
                        @include('pageAdmin.matakuliah.modal.import')
                        
                        <button data-modal-target="tambah-matakuliah" data-modal-toggle="tambah-matakuliah"
                            class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-800"><i
                                class="fa-solid fa-plus"></i>
                        </button>
                        {{-- MODAL TAMBAH MATA KULIAH --}}
                        @include('pageAdmin.matakuliah.modal.tambah')
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div id="tableMatakuliah">
                    @include('pageAdmin.matakuliah.table', ['matakuliah' => $matakuliah])
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
