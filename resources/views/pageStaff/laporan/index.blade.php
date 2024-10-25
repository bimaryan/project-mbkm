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
                        <a href="{{ route('laporan.export') }}"
                            class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-800">
                            <i class="fa-solid fa-file-export"></i>
                        </a>
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
@endsection
