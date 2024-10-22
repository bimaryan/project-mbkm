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
                        <h3 class="text-2xl font-semibold text-green-500">Ruang Laboratorium</h3>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <button class="justify-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800"
                                data-modal-target="import-mahasiswa" data-modal-toggle="import-mahasiswa"><i
                                    class="fa-solid fa-file-import"></i>
                            </button>

                            @include('admin.ruangan.modal.import')

                            <button data-modal-target="tambah-ruangan" data-modal-toggle="tambah-ruangan"
                                class="justify-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>

                        {{-- MODAL TAMBAH MAHASISWA --}}
                        @include('admin.ruangan.modal.tambah')
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">

                <div id="tableRuangan">
                    @include('admin.ruangan.table', ['ruangan' => $ruangan])
                </div>

                {{-- <div id="pageignitionLinks">
                    {{ $ruangan->links() }}
                </div> --}}
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
                    url: "{{ route('data-ruangan') }}",
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
                        $('#tableRuangan').html($(response).find('#tableRuangan').html());
                        $('#paginationLinks').html($(response).find('#paginationLinks').html());
                    }
                });
            }
        });
        $(document).ready(function() {
            $('#data-mahasiswa').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: '300px',
            });
        });
    </script>
@endsection
