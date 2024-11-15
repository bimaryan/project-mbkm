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
                        <h3 class="text-2xl font-semibold text-green-500">Link API</h3>
                    </div>
                    <div>
                        <button data-modal-target="tambah-kelas" data-modal-toggle="tambah-kelas"
                            class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-800"><i
                                class="fa-solid fa-plus"></i>
                        </button>

                        {{-- MODAL TAMBAH KELAS --}}
                        @include('pageAdmin.peraturan.linkapi.modal.tambah')
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div id='tableLink'>

                    @include('pageAdmin.peraturan.linkapi.table', ['linkapi' => $linkapi])
                </div>

                <div id="pageignitionLinks">
                    {{-- {{ $linkapi->links() }} --}}
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
                        url: "{{ url('settings/link-api') }}",
                        method: "GET",
                        data: {
                            link_api: $('#link_api').val(),
                            // page: page
                        },
                        success: function(response) {
                            // Replace table and pagination links
                            $('#tableLink').html($(response).find('#tableLink').html());
                        }
                    });
                }
            });
            $(document).ready(function() {
                $('#link-api').DataTable({
                    paging: true,
                    pageLength: 5,
                    scrollCollapse: true,
                    scrollY: '300px',
                });
            });
        </script>
    </div>
@endsection
