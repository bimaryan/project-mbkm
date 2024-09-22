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
    <title>SILK &mdash; Barang {{ $view->name }}</title>

    <style>
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

    <div class="max-w-screen-xl mx-auto p-6 mt-14">
        <div class="flex justify-between items-center mt-6">
            <div>
                <p class="text-2xl text-green-500 font-semibold">Form Peminjaman</p>
            </div>
            <div>
                <a href="{{ route('mahasiswa.katalog') }}"
                    class="px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"><i
                        class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-5">
            <div class="flex justify-center w-full">
                <img src="{{ asset($view->gambar) }}" alt="{{ asset($view->gambar) }}"
                    class="object-cover rounded-lg shadow-lg border border-green-500 image">
            </div>
            <div class="space-y-3">
                <p class="text-3xl font-semibold">{{ $view->name }}</p>
                <p class="text-m text-gray-500">{{ $view->deskripsi }}</p>
            </div>
            <div>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Kelas</label>
                        <input type="text" name="kelas" id="kelas"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Jurusan/Prodi</label>
                        <input type="text" name="kelas" id="kelas"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Mata Kuliah</label>
                        <input type="text" name="kelas" id="kelas"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Jumlah</label>
                        <input type="text" name="kelas" id="kelas"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Ruang Lab</label>
                        <input type="text" name="kelas" id="kelas"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="kelas" class="block text-lg font-medium text-gray-700">Dosen Pengampu</label>
                        <input type="text" name="kelas" id="kelas"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="w-full bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
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
