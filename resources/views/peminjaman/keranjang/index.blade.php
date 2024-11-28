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
    <title>SILK &mdash; Keranjang</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            font-style: normal;
        }

        .zoom-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .animate-card {
            transform: translateY(50px);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.5s;
        }

        .animate-card.in-view {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
</head>

<body class="bg-gray-200">
    @include('peminjaman.navbar.index')

    <br/>

    <div class="p-4 space-y-3">
        <div class="max-w-screen-xl p-4 mx-auto mt-14 bg-white rounded-xl">
            <h2 class="text-xl text-center font-medium">Keranjang</h2>
        </div>

        @foreach ($keranjang as $data)
            <div class="max-w-screen-xl p-4 mx-auto mt-14 bg-white rounded-xl">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="flex items-center gap-2">
                            <img src="{{ $data->barang->foto }}" class="w-12" alt="{{ $data->barang->foto }}">
                            <p class="text-sm">{{ $data->barang->nama_barang }}</p>
                        </div>
                    </div>
                    <div class="flex justify-center items-center text-center">
                        <div class="px-4">
                            <p class="text-sm text-gray-900">{{ $data->stock_pinjam }}</p>
                        </div>
                        <div class="px-4">
                            <form action="{{ route('keranjang.hapus', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('peminjaman.footer.index')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
