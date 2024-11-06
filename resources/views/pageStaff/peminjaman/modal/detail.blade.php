<div id="detail{{ $item->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Detail Verifikasi Peminjaman
                </h3>
                <button type="button"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="detail{{ $item->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6">
                <div class="flex flex-col gap-4 md:flex-row">
                    <!-- Labels -->
                    <div class="space-y-3 text-left">
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>NIM</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Nama Mahasiswa</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Kelas</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Mata Kuliah</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Dosen Pengampu</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Ruangan</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Barang</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Jumlah Pinjam</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Tanggal Peminjaman</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Waktu Peminjaman</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Waktu Pengembalian</span>
                            <span>:</span>
                        </p>
                        <p class="flex justify-between text-sm font-medium text-gray-900 dark:text-white">
                            <span>Status Peminjaman</span>
                            <span>:</span>
                        </p>
                    </div>
                    <!-- Values -->
                    <div class="space-y-3 text-left">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->mahasiswa->nim }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->mahasiswa->nama }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->mahasiswa->kelas->nama_kelas }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->matkul->mata_kuliah }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->dosen->nama_dosen }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->ruangan->nama_ruangan ?? '-' }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->barang->nama_barang }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->stock_pinjam }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->tgl_pinjam }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->waktu_pinjam }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->waktu_kembali }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->status }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
