@extends('index')
@section('content')
    <div class="p-4 mt-3 sm:ml-64">
        <div class="space-y-4 rounded-lg mt-14">
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold text-green-500">Laporan Peminjaman</h3>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('laporan.export') }}" data-tooltip-target="export" data-tooltip-placement="left"
                                class="justify-center px-4 py-2
                            text-white bg-green-500 rounded hover:bg-green-800">
                                <i class="fa-solid fa-file-arrow-down"></i>
                            </a>

                            <div id="export" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Export
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">

                <div id="tableLaporan">
                    @include('pageStaff.laporan.table', ['peminjamans' => $peminjamans])
                </div>

                <div id="paginationLinks" class="mt-4">
                    {{ $peminjamans->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-laporan').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: '300px',
                info: false,
                searching: false,
            });
        });
    </script>
@endsection
