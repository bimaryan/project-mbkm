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
                                    Mahasiswa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    kelas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jurusan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SPO Dokumen
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Ruangan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dosen
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Mata Kuliah
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
                                    aprovals
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $item)
                                <tr>
                                    <td scope="col" class="px-6 py-3">{{ $loop->iteration }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->mahasiswa->nama }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->barang->name }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->stock->stock_pinjam }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->kelas->kelas }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->jurusan->jurusan }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->spo->file ?? 'null' }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->room->ruangan }}</td>
                                    <td scope="col" class="px-6 py-3">Dosen</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->matkul }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->tgl_pinjam }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->tgl_kembali }}</td>
                                    <td scope="col" class="px-6 py-3">{{ $item->keterangan ?? 'null' }}</td>
                                    <td scope="col" class="px-6 py-3">
                                        <form action="{{ route('verifikasi.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <select name="aprovals" id="aprovals" class="border rounded-md p-2">
                                                    <option value="Belum"
                                                        {{ $item->aprovals == 'Belum' ? 'selected' : '' }}>Belum</option>
                                                    <option value="Disetujui"
                                                        {{ $item->aprovals == 'Disetujui' ? 'selected' : '' }}>Disetujui
                                                    </option>
                                                    <option value="Ditolak"
                                                        {{ $item->aprovals == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                                    </option>
                                                </select>
                                                <button>

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
