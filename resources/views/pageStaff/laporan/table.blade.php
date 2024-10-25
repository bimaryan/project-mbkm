<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Mahasiswa
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Pinjam
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal Dipinjam
                </th>
                <th scope="col" class="px-6 py-3">
                    Jam Pinjam
                </th>
                <th scope="col" class="px-6 py-3">
                    Jam Kembali
                </th>
                <th scope="col" class="px-6 py-3">
                    Kondisi
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $data)
                <tr>
                    <td scope="col" class="px-6 py-3">
                        {{ $loop->iteration }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->mahasiswa->nama }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->barang->nama_barang }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->stock_pinjam }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->tgl_pinjam }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->waktu_pinjam }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->waktu_pinjam }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->barang->kondisi->kondisi }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
