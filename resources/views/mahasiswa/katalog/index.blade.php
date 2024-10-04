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
    <title>SILK &mdash; Katalog</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            font-style: normal;
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

        .animate-slide {
            transform: translateX(15px);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.5s;
        }

        .animate-slide.in-view {
            transform: translateX(0);
            opacity: 1;
        }
    </style>
</head>

<body>
    @include('mahasiswa.navbar.index')

    <div class="max-w-screen-xl mx-auto p-6 mt-14">
        <form method="GET" action="{{ route('mahasiswa.katalog') }}"
            class="flex justify-center items-center gap-2 mb-4 mt-6">
            {{-- Tombol Semua Kategori --}}
            <button type="submit" name="kategori" value="Semua"
                class="px-3 py-2 rounded-lg border shadow-xl {{ request('kategori') == 'Semua' ? 'bg-green-800 text-white' : 'border-green-500 hover:bg-green-800 hover:text-white' }}">
                Semua
            </button>

            {{-- Tombol untuk setiap kategori --}}
            @foreach ($kategoris as $kategori)
                <button type="submit" name="kategori" value="{{ $kategori->kategori }}"
                    class="px-3 py-2 rounded-lg border shadow-xl {{ request('kategori') == $kategori->kategori ? 'bg-green-800 text-white' : 'border-green-500 hover:bg-green-800 hover:text-white' }}">
                    {{ $kategori->kategori }}
                </button>
            @endforeach
        </form>

        {{-- Bagian Kartu Barang --}}
        @if ($barangKosong)
            <p class="text-center text-gray-500 mt-6">Tidak ada barang yang tersedia untuk kategori ini.</p>
        @else
            <div id="card-section" class="grid grid-cols-1 md:grid-cols-3 gap-2 animate-card">
                @foreach ($barangs as $data)
                    <a href="{{ route('mahasiswa.viewbarang', ['name' => $data->name]) }}"
                        class="w-full rounded-lg border border-green-500 max-w-m shadow-lg p-3">
                        <div class="flex justify-center w-full">
                            <img src="{{ url($data->gambar) }}" class="object-cover zoom-image"
                                alt="{{ $data->name }}" />
                        </div>
                        <div class="mt-1">
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                {{ $data->kategori->kategori }}
                            </span>
                        </div>
                        <div class="mt-1">
                            <p class="font-normal">{{ Str::limit($data->name, 50) }}</p>
                            <p class="text-sm font-normal text-gray-600">{{ Str::limit($data->deskripsi, 50) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        <div class="mt-4">
            {{ $barangs->links() }}
        </div>
    </div>

    @include('mahasiswa.footer.index')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, scrollPosition);
                sessionStorage.removeItem('scrollPosition');
            }
        });

        window.addEventListener('beforeunload', () => {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });

        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.animate-card');

            const observerOptions = {
                threshold: 0.1,
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                    } else {
                        entry.target.classList.remove('in-view');
                    }
                });
            }, observerOptions);

            cards.forEach(card => {
                observer.observe(card);
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.animate-slide');

            const observerOptions = {
                threshold: 0.1,
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                    } else {
                        entry.target.classList.remove('in-view');
                    }
                });
            }, observerOptions);

            slides.forEach(slide => {
                observer.observe(slide);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
