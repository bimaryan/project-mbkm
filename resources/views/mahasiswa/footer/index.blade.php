<footer class="w-full bg-white border dark:bg-gray-900">
    <div class="w-full max-w-screen-xl mx-auto">
        <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-3">
            <div class="mb-6 md:mb-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('logo/polindra.png') }}" style="width: 30%"
                        alt="{{ asset('logo/polindra.png') }}" />
                    <span class="self-center text-2xl font-semibold text-green-500 whitespace-nowrap">SILK</span>
                </a>
            </div>

            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Tautan</h2>
                <ul class="font-medium text-gray-500 dark:text-gray-400">
                    <li class="mb-4">
                        <a href="{{ route('home') }}" class="hover:underline">Home</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('katalog') }}" class="hover:underline">Katalog</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('mahasiswa.informasi') }}" class="hover:underline">Informasi</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Alamat & Kontak</h2>
                <div>
                    <p class="flex font-medium text-gray-900 dark:text-white">
                        <span class="me-2"><i class="fa-solid fa-location-dot"></i></span>
                        <span>
                            Jl. Lohbener Lama No.08, Lohbener, Legok, Indramayu, Kabupaten Indramayu, Jawa Barat
                            <br>
                            45252
                        </span>
                    </p>
                    <p class="flex font-medium text-gray-900 dark:text-white">
                        <span class="me-2"><i class="fa-solid fa-phone"></i></span>
                        (0234) 5746464
                    </p>
                    <p class="flex font-medium text-gray-900 dark:text-white">
                        <span class="me-2"><i class="fa-solid fa-envelope"></i></span>
                        info@polindra.ac.id
                    </p>
                </div>


            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a
                href="https://polindra.ac.id" class="hover:underline">Polindra</a>. All Rights Reserved.</span>
    </div>
</footer>
