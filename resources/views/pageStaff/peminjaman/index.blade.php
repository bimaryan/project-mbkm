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

            @if (session('error'))
                <script>
                    Swal.fire({
                        title: "Error",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                    });
                </script>
            @endif

            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold text-green-500">Verifikasi Peminjaman</h3>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">

                <div id="tablePeminjaman">
                    @include('pageStaff.peminjaman.table', ['peminjamans' => $peminjamans])
                </div>

                <div id="pageignitionLinks">
                    {{ $peminjamans->links() }}
                </div>
            </div>
        </div>
    </div>
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
                    url: "{{ route('verifikasi') }}",
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
                        $('#tablePeminjaman').html($(response).find('#tablePeminjaman').html());
                        $('#paginationLinks').html($(response).find('#paginationLinks').html());
                    }
                });
            }
        });
        $(document).ready(function() {
            $('#data-peminjaman').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: '300px',
            });
        });
    </script>
@endsection
