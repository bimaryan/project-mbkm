<div id="detail{{ $data->id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Detail Admin dan Staff
                </h3>
                <button type="button"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="detail{{ $data->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4">
                <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                    <!-- Image -->
                    <div class="flex justify-center mb-3">
                        <img src="" alt="gambar" class="object-cover border rounded-lg">
                    </div>
                    <div>
                        <div>
                            Nama Lengkap : {{ $data->nama }}
                        </div>
                        <div class="mt-4">
                            NIP : {{ $data->nip }}
                        </div>
                        <div class="mt-4">
                            Username : {{ $data->username }}
                        </div>
                        <div class="mt-4">
                            Email : {{ $data->email }}
                        </div>
                        <div class="mt-4">
                            Role : {{ $data->role->nama_role }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>