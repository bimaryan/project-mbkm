<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-center text-gray-500 display dark:text-gray-400" style="100%" id="link-api">
        <thead class="uppercase text-cen-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Link API</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($linkapi as $data)
                <tr id="link_api"
                    class="bg-white border-b dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $data->link_api }}</td>
                    <td scope="col" class="flex items-center justify-center gap-2 px-6 py-4">
                        <button type="button" data-modal-target="detail{{ $data->id }}"
                            data-modal-toggle="detail{{ $data->id }}"
                            class="flex items-center px-2 py-2 text-sm text-white bg-yellow-400 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>

                        <!-- Delete Form -->
                        <form action="{{ url('settings/link-api/' . $data->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center px-2 py-2 text-sm text-white bg-red-500 rounded">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>

                        <!-- Edit Button -->
                        <button type="button" data-modal-target="edit{{ $data->id }}"
                            data-modal-toggle="edit{{ $data->id }}"
                            class="flex items-center px-2 py-2 text-sm text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </td>
                </tr>

                @include('pageAdmin.peraturan.linkapi.modal.detail')

                <!-- Edit Modal -->
                <div id="edit{{ $data->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full p-4">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit Link API
                                </h3>
                                <button type="button"
                                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="edit{{ $data->id }}">
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
                                <form action="{{ url('settings/link-api/' . $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="gap-2">
                                        <div class="mb-2">
                                            <label for="link_api" class="block text-sm font-medium text-gray-700">Link
                                                API</label>
                                            <input type="text" name="link_api" id="link_api"
                                                value="{{ $data->link_api }}"
                                                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                            @error('link_api')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-green-500 mt-4 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
