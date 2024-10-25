<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <title>SILK &mdash; Barang {{ $view->name }}</title>

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
    @include('mahasiswa.navbar.index')

    <div class="max-w-screen-xl p-6 mx-auto mt-14">
        <div class="flex items-center mt-6">
            <div>
                <p class="text-2xl font-semibold text-green-500">
                    <a href="{{ route('katalog') }}">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    Form Peminjaman
                </p>
            </div>
        </div>

        <hr class="my-3">

        <div class="grid grid-cols-1 gap-3 mt-5 md:grid-cols-2">
            <div class="space-y-3">
                <div class="flex justify-center w-full">
                    <img src="{{ asset($view->foto) }}" alt="{{ asset($view->foto) }}"
                        class="object-cover border border-green-500 rounded-lg shadow-lg image">
                </div>
                <p class="text-2xl font-semibold">{{ $view->nama_barang }}</p>
            </div>
            <div>
                <form action="{{ route('mahasiswa.peminjaman', ['barang' => $view->id, 'stock' => $stock->id]) }}"
                    method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Kelas</label>
                        <input type="text" name="kelas" id="kelas"
                            value="{{ Auth::user()->kelas->nama_kelas }}" disabled
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="matkul" class="block text-lg font-medium text-gray-700">Mata Kuliah</label>
                        <select name="matkul_id" id="matkul"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach ($matkul as $matkuls)
                                <option value="{{ $matkuls->id }}">{{ $matkuls->mata_kuliah }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="dosen" class="block text-lg font-medium text-gray-700">Dosen</label>
                        <select name="dosen_id" id="dosen"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            <option value="">Pilih Dosen</option>
                            @foreach ($dosen as $dosens)
                                <option value="{{ $dosens->id }}">{{ $dosens->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="rooms" class="block text-lg font-medium text-gray-700">Ruangan</label>
                        <select name="rooms_id" id="rooms_id"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            <option value="">Pilih Ruangan</option>
                            @foreach ($ruangan as $ruangan)
                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="jumlah_pinjam" class="block text-lg font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="jumlah_pinjam" id="jumlah_pinjam" min="1"
                            placeholder="Masukkan Jumlah Barang yang di pinjam"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="tgl_pinjam" class="block text-lg font-medium text-gray-700">Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" id="tgl_pinjam"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="waktu_pinjam" class="block text-lg font-medium text-gray-700">Waktu Peminjaman</label>
                        <input type="time" name="waktu_pinjam" id="waktu_pinjam"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="waktu_kembali" class="block text-lg font-medium text-gray-700">Waktu Pengembalian</label>
                        <input type="time" name="waktu_kembali" id="waktu_kembali"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-green-500 rounded-md shadow-md hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('mahasiswa.footer.index')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
