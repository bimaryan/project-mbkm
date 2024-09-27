@extends('index')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="rounded-lg mt-14 space-y-4">
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <p class="text-lg font-semibold">Dashboard</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                <div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <p class="text-lg font-semibold">Data Alat</p>
                    </div>
                </div>
                <div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <p class="text-lg font-semibold">Data Bahan</p>
                    </div>
                </div>
                <div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <p class="text-lg font-semibold">Total Peminjaman</p>
                    </div>
                </div>
                <div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <p class="text-lg font-semibold">Total Mahasiswa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
