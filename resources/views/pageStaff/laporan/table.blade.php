<div class="relative overflow-x-auto sm:rounded-lg">
    <form method="GET" action="{{ route('laporan') }}" class="mb-4 mt-2">
        <div class="flex gap-4 items-center">
            <!-- Filter Bulan -->
            <select name="bulan"
                class="p-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                <option value="">Pilih Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromDate(null, $i, 1)->format('F') }}
                    </option>
                @endfor
            </select>

            <!-- Filter Tahun -->
            <select name="tahun"
                class="p-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                <option value="">Pilih Tahun</option>
                @for ($year = date('Y'); $year >= 2000; $year--)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endfor
            </select>

            <!-- Tombol Submit -->
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">
                Filter
            </button>
        </div>
    </form>

    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400" id="data-laporan">
        <thead class="uppercase text-cen-gray-700 dark:text-gray-400">
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
                @if ($data->status_pengembalian == 'Diserahkan')
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
                @endif
            @endforeach
        </tbody>
    </table>
</div>
