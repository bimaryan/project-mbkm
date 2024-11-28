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
    <link rel="icon" href="{{ asset('logo/polindra.png') }}" type="image/x-icon">
    <title>SILK &mdash; Barang {{ $view->name }}</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            font-style: normal;
        }

        .image {
            width: 1080px;
            height: 200px;
            object-fit: auto;
            transition: transform 0.3s ease;
        }

        .foto {
            width: 60px;
        }
    </style>
</head>

<<<<<<< HEAD
<body class="bg-gray-200">
=======
<body>
>>>>>>> 2dd4ed6370eb5dbf1a73259d9543443952af7f68
    @include('peminjaman.navbar.index')

    <br>

    <div class="space-y-3 p-4">
        <div class="max-w-screen-xl p-6 mx-auto mt-14 bg-white rounded-xl">
            <div class="space-y-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="w-full">
                    <img src="{{ asset($view->foto ?? 'image/barang.png') }}" alt="{{ asset($view->foto) }}"
                        class="object-cover rounded-lg image">
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xl font-semibold">{{ $view->nama_barang }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ $view->kategori->kategori }}</span>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ $view->satuan->satuan }}</span>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ $view->kondisi->kondisi }}</span>
                        </div>
                        <div>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">Sisa
                                {{ $view->stock->stock }}</span>
                        </div>
                    </div>
                    <div>
                        <form action="{{ route('keranjang.tambah', ['barang' => $view->id, 'stock' => $stock->id]) }}"
                            method="POST">
                            @csrf
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium">Kuantitas</p>
                                </div>
                                <div class="flex items-center border rounded-xl">
                                    <!-- Tombol Minus -->
                                    <button type="button" class="p-2" onclick="decrement()">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <!-- Input Kuantitas -->
                                    <input type="number" name="stock_pinjam" id="stock_pinjam" class="w-15 text-center"
                                        value="1" min="1" max="{{ $view->stock->stock }}" readonly>
                                    <!-- Tombol Plus -->
                                    <button type="button" class="p-2" onclick="increment()">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit"
                                    class="px-4 py-2 w-full text-white bg-green-500 rounded-lg hover:bg-green-800">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-xl p-6 mx-auto mt-14 bg-white rounded-xl">
            <div class="flex items-center">
                <div class="flex items-center gap-3">
                    <div>
                        <img src="{{ asset('image/icon_profile.png') }}" alt="" class="object-cover foto">
                    </div>
                    <div>
                        <p class="text-sm font-medium">Admin</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-screen-xl p-6 mx-auto mt-14 bg-white rounded-xl space-y-2">
            <div>
<<<<<<< HEAD
                <h2 class="text-lg font-medium">Deskripsi Barang</h2>
            </div>
            <div>
                <p class="text-sm text-gray-100">{!! nl2br(e($view->deskripsi)) !!}</p>
=======
                <form action="{{ route('peminjaman', ['barang' => $view->id, 'stock' => $stock->id]) }}"
                    method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Kelas</label>
                        <p type="text" name="kelas" id="kelas"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            {{ Auth::user()->kelas->nama_kelas }}</p>
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
                        <select name="ruangan_id" id="ruangan_id"
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
                        <input type="text" datepicker datepicker-buttons datepicker-autoselect-today
                            name="tgl_pinjam" id="tgl_pinjam" placeholder="Pilih tanggal pinjam"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>

                    <div class="flex flex-row items-center w-full gap-2 mb-4">
                        <div class="w-full">
                            <label for="waktu_pinjam" class="block text-lg font-medium text-gray-700">Waktu
                                Peminjaman</label>
                            <input type="time" name="waktu_pinjam" id="waktu_pinjam"
                                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        </div>

                        <div class="w-full">
                            <label for="waktu_kembali" class="block text-lg font-medium text-gray-700">Waktu
                                Pengembalian</label>
                            <input type="time" name="waktu_kembali" id="waktu_kembali"
                                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="tgl_pinjam" class="block text-lg font-medium text-gray-700">Keterangan</label>
                        <textarea type="text" name="keterangan" id="keterangan" rows="5"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-green-500 rounded-md shadow-md hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Submit
                        </button>
                    </div>
                </form>
>>>>>>> 2dd4ed6370eb5dbf1a73259d9543443952af7f68
            </div>
        </div>
    </div>

    @include('peminjaman.footer.index')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    <script>
        // Fungsi untuk menambah jumlah_pinjam
        function increment() {
            let input = document.getElementById('stock_pinjam');
            let currentValue = parseInt(input.value);
            let maxValue = parseInt(input.getAttribute('max'));

            if (currentValue < maxValue) {
                input.value = currentValue + 1;
            }
        }

        // Fungsi untuk mengurangi jumlah_pinjam
        function decrement() {
            let input = document.getElementById('stock_pinjam');
            let currentValue = parseInt(input.value);
            let minValue = parseInt(input.getAttribute('min'));

            if (currentValue > minValue) {
                input.value = currentValue - 1;
            }
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: "#3085d6",
            });
        @endif

        // Display error message using SweetAlert2
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: "#3085d6",
            });
        @endif
    </script>
</body>

</html>
