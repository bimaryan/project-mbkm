<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('logo/polindra.png') }}" type="image/x-icon">
    <title>SILK &mdash; Register</title>
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

<body class="flex flex-col items-center justify-center h-screen space-y-4 background p-4">

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

    <div class="flex justify-center">
        <img src="{{ asset('logo/polindra.png') }}" alt="" class="object-cover w-full h-24">
    </div>

    <div class="w-full max-w-sm p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl mb-6 font-bold text-center text-green-500">Daftar Mahasiswa</h2>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Username -->
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Username Mahasiswa</label>
                <input type="name" id="name" name="name"
                    class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    placeholder="2205036">
                @error('name')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-600">Nama Lengkap</label>
                <input type="nama_lengkap" id="nama_lengkap" name="nama_lengkap"
                    class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    placeholder="Bima Ryan Alfarizi">
                @error('nama_lengkap')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Kata Sandi</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    placeholder="********">
                <p id="password-error" class="text-sm text-red-500 mt-2 hidden">Kata sandi anda kurang dari 8 karakter
                </p>
                @error('password')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Daftar</button>
        </form>

        <!-- Forgot Password -->
        <p class="mt-4 text-sm text-center text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-green-500 hover:underline">Masuk</a>
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>

<script>
    function validatePassword() {
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('password-error');
        const password = passwordInput.value;

        if (password.length < 8) {
            passwordError.classList.remove('hidden');
            return false;
        }

        passwordError.classList.add('hidden');
        return true;
    }
</script>
