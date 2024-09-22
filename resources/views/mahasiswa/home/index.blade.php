@extends('mahasiswa.index')
@section('content')
    <style>
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

    <div class="p-6 mx-auto">
        <div class="flex justify-end items-center p-6 h-screen">
            <div class="max-w-md animate-slide space-y-5">
                <h2 class="text-8xl font-medium text-green-500 text-center">SILK</h2>
                <p class="text-lg text-center text-white font-semibold">
                    Sistem Laboratorium Kesehatan adalah sebuah sistem berbasis teknologi yang dirancang untuk
                    mempermudah proses peminjaman, pengembalian, serta pengelolaan inventaris laboratorium secara
                    digital.
                </p>
                <div class="flex justify-center items-center">
                    <a href="#filter-section"
                        class="px-4 py-3 rounded-xl border border-green-500 border-1 bg-gray-100 text-green-500 text-m font-semibold hover:bg-green-800 hover:text-white">Pinjam
                        Sekarang!</a>
                </div>
            </div>
        </div>

        <div class="max-w-screen-xl mx-auto" id="filter-section">
            <div class="bg-white rounded-xl w-full space-y-5 p-6">
                <p class="text-green-500 text-3xl text-center font-semibold">Alat dan Bahan Laboratorium</p>
                <p class="text-gray-500 text-m text-center">Laboratorium Kesehatan Politeknik Negeri Indramayu memiliki
                    lebih dari 1500 alat laboratorium yang dapat dipinjam untuk mahasiswa. Ketersediaan alat
                    laboratorium
                    diperbarui secara akurat dan
                    real-time untuk menghindari tumpang tindih pemesanan.</p>

                {{-- Form Filter --}}
                <form method="GET" action="{{ route('mahasiswa') }}" class="flex justify-center items-center gap-2 mb-4">
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
                                class="w-full max-w-m p-3 rounded-lg border border-green-500 shadow-lg">
                                <div class="flex justify-center w-full">
                                    <img src="{{ url($data->gambar) }}"
                                        class="object-cover zoom-image"
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
            </div>
        </div>
    </div>

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
@endsection
