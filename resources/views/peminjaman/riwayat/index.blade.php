<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ asset('logo/polindra.png') }}" type="image/x-icon">
    <title>SILK &mdash; Riwayat Peminjaman</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            font-style: normal;
        }

        .image {
            width: 100%;
            height: 200px;
            object-fit: auto;
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body>
    @include('peminjaman.navbar.index')

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#3085d6",
            });
        </script>
    @endif

    <div class="max-w-screen-xl mx-auto p-6 mt-14">
        <div class="flex justify-center items-center mt-6">
            <div>
                <p class="text-2xl text-green-500 font-semibold">
                    Riwayat Peminjaman
                </p>
            </div>
        </div>

        <hr class="my-3">

        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-gray-700 uppercase dark:text-gray-400 bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama Mahasiswa</th>
                        <th scope="col" class="px-6 py-3">Nama Barang</th>
                        <th scope="col" class="px-6 py-3">Jumlah Barang</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($riwayat->isEmpty())
                        <tr>
                            <td colspan="7" class="px-6 py-3 text-center text-gray-500 border">
                                Tidak ada peminjaman
                            </td>
                        </tr>
                    @else
                        @foreach ($riwayat as $data)
                            @if ($data->status === 'Dikembalikan')
                                <tr class="border-gray-200 border-b">
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
                                        {{ $data->status }}
                                    </td>
                                    <td scope="col" class="px-6 py-3 flex justify-center items-center gap-2">
                                        <div>
                                            <button type="button" data-modal-target="detail{{ $data->id }}"
                                                data-modal-toggle="detail{{ $data->id }}"
                                                class="py-2 px-2 bg-yellow-400 rounded text-sm text-white flex items-center">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            <div id="detail{{ $data->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Detail Peminjaman
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="detail{{ $data->id }}">
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

                                        <div class="p-4 flex flex-col md:flex-row items-center gap-5">
                                            <div class="w-44 flex justify-center rounded-lg">
                                                <img src="{{ asset($data->foto ?? 'image/barang.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <div class="space-y-2">
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Nim Mahasiswa</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Nama Mahasiswa</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Kelas Mahasiswa</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Nama Ruangan</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Nama Barang</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Jumlah Barang</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Tanggal Pinjam</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Waktu Peminjaman</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Waktu Pengembalian</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Keterangan</span>
                                                        <span>:</span>
                                                    </p>
                                                    <p
                                                        class="text-sm text-gray-900 dark:text-white font-medium flex justify-between">
                                                        <span>Status</span>
                                                        <span>:</span>
                                                    </p>
                                                </div>
                                                <div class="space-y-2">
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $data->mahasiswa->nim }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $data->mahasiswa->nama }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ Auth::user()->kelas->nama_kelas }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $data->ruangan->nama_ruangan ?? 'null' }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $data->barang->nama_barang }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $data->stock_pinjam }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ \Carbon\Carbon::parse($data->tgl_pinjam)->format('d M Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ \Carbon\Carbon::parse($data->waktu_pinjam)->format('H:i') }}
                                                        WIB
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ \Carbon\Carbon::parse($data->waktu_kembali)->format('H:i') }}
                                                        WIB
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $data->keterangan ?? 'Tidak ada keterangan' }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $data->status }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $riwayat->links() }}
        </div>
    </div>

    @include('peminjaman.footer.index')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
