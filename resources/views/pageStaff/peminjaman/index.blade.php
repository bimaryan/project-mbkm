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
                                    <td scope="col" class="px-6 py-3">Dosen</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->room->ruangan }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
