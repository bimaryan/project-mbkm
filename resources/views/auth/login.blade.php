<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Project 3 - Login</title>
    <style>
        .background {
            position: relative;
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('image/iteralab.png') }}');
            background-size: cover;
            background-position: center;
            filter: blur(3px);
            z-index: -1;
        }
    </style>
</head>

<body>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#3085d6",
            });
        </script>
    @endif

    <div class="flex background flex-col items-center justify-center h-screen space-y-4 p-4">
        <div class="flex justify-center">
            <img src="{{ asset('image/kampus-merdeka.png') }}" alt="" class="w-full object-cover">
        </div>

        <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-6 text-3xl font-bold text-center text-green-500">Masuk</h2>

            <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="nim" class="block mb-2 text-sm font-medium text-gray-600">NIM</label>
                    <input type="nim" id="nim" name="nim"
                        class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="2205036">
                    @error('nim')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Kata Sandi</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="********">
                    @error('password')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Masuk</button>
            </form>

            <!-- Forgot Password -->
            <p class="mt-4 text-sm text-center text-gray-600">
                Belum punya akun? <a href="{{ route('register') }}" class="text-green-500 hover:underline">Daftar</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
