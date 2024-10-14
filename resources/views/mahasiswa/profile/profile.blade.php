@extends('mahasiswa.profile.index')

@section('content-profile')
    <!-- Main Content -->
    <main class="flex-1 p-8">
        <div class="p-8 bg-white rounded-lg shadow-md">
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
            <h1 class="mb-6 text-2xl font-bold">Pengaturan Data Diri</h1>
            <form action="{{ route('editProfile', auth()->user()->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center mb-6">
                    <div class="relative w-32 h-32 overflow-hidden rounded-full">
                        <img id="profileImage" src="https://via.placeholder.com/150" alt="Foto Profil"
                            class="object-cover w-full h-full">
                        <input type="file" id="uploadImage" accept="image/*"
                            class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama
                        Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ auth()->user()->nama }}"
                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">No.
                        Handphone</label>
                    <input type="text" id="phone" name="telepon" value="{{ auth()->user()->telepon }}"
                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                </div>
                <div class="mb-6">
                    <span class="block mb-4 text-sm font-medium text-gray-700">Jenis Kelamin</span>
                    <div class="flex items-center mb-4">
                        <input id="laki-laki" type="radio" value="laki-laki" name="jenis_kelamin"
                            {{ auth()->user()->jenis_kelamin == 'laki-laki' ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="laki-laki"
                            class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">Laki-laki</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input id="perempuan" type="radio" value="perempuan" name="jenis_kelamin"
                            {{ auth()->user()->jenis_kelamin == 'perempuan' ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="perempuan"
                            class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">Perempuan</label>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="text-blue-600">Batal</button>
                    <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </main>
@endsection
