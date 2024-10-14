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
        <h1 class="mb-6 text-2xl font-bold">Ubah Kata Sandi</h1>
        <form action="{{ route('ubah-kata-sandi', auth()->user()->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                <input type="password" id="password" name="password"
                    value=""
                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="password" name="konfirmasi_password"
                    value=""
                    class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" class="text-blue-600">Batal</button>
                <button type="submit"
                    class="px-4 py-2 text-white bg-green-500 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</main>
@endsection