@extends('index')
@section('content')
    <div class="p-4 sm:ml-64 mt-3">
        <div class="rounded-lg mt-14 space-y-4">
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
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl text-green-500 font-semibold">Verifikasi Peminjaman</h3>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nim
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Mahasiswa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    kelas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Mata Kuliah
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dosen
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Ruangan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SPO Dokumen
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Pinjam
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Kembali
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aprovals
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Verifikasi Pengembalian
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $item)
                                <tr>
                                    <td scope="col" class="px-6 py-3">{{ $loop->iteration }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->mahasiswa->nim }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->mahasiswa->nama }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->mahasiswa->kelas->nama_kelas }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->matkul->mata_kuliah }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->dosen->nama_dosen }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->ruangan->nama_ruangan }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->barang->nama_barang }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->stock_pinjam }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->spo->file ?? 'Tidak ada file' }}</td>
                                    <td scope="col" class="px-6 py-3">
                                        {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</td>
                                    <td scope="col" class="px-6 py-3">
                                        {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}</td>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $item->keterangan ?? 'Tidak ada keterangan' }}
                                    </td>
                                    <td scope="col" class="px-6 py-3">{{ $item->status }}</td>
                                    <td scope="col" class="px-6 py-3">
                                        <form action="{{ route('verifikasi.update', $item->id) }}" method="POST"
                                            class="flex items-center gap-1">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <select name="aprovals" id="aprovals" class="border rounded-md p-2">
                                                    <option value="Belum"
                                                        {{ $item->aprovals == 'Belum' ? 'selected' : '' }}>Belum</option>
                                                    <option value="Ya" {{ $item->aprovals == 'Ya' ? 'selected' : '' }}>
                                                        Ya
                                                    </option>
                                                    <option value="Tidak"
                                                        {{ $item->aprovals == 'Tidak' ? 'selected' : '' }}>Tidak
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="bg-green-500 px-4 py-3 rounded-lg text-white font-medium">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                        <div class="flex justify-center items-center">
                                            <button type="button" data-modal-target="verifikasi{{ $item->id }}"
                                                data-modal-toggle="verifikasi{{ $item->id }}"
                                                class="px-4 py-4 bg-green-500 rounded text-sm text-white flex items-center">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <div id="verifikasi{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Verifikasi Pengembalian
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="verifikasi{{ $item->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div class="p-4">
                                                <form action="{{ route('verifikasi.kembali', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <label for="status_pengembalian"
                                                        class="block text-lg font-medium text-gray-700">Verifikasi
                                                        Pengembalian</label>
                                                    <div class="flex items-center gap-2">
                                                        <select name="status_pengembalian" id="status_pengembalian"
                                                            class="block w-full border p-3 mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                            <option value="Belum"
                                                                {{ $item->status_pengembalian == 'Belum' ? 'selected' : '' }}>
                                                                Belum
                                                            </option>
                                                            <option value="Diserahkan"
                                                                {{ $item->status_pengembalian == 'Diserahkan' ? 'selected' : '' }}>
                                                                Diserahkan
                                                            </option>
                                                        </select>

                                                        <button type="submit"
                                                            class="bg-green-500 px-4 py-3 rounded-lg text-white font-medium">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $peminjamans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
