<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm tex-center text=grey-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:bg-gray-40">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Kelas</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $data)
                <tr
                    class="bg-white border-b dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $data->kelas }}</td>
                    <td scope="col" class="flex items-center justify-center gap-2 px-6 py-4">
                        <form id="delete-form-{{ $data->id }}"
                            action="{{ route('data-kelas.delete', $data->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $data->id }})"
                                class="flex items-center px-2 py-2 text-sm text-white bg-red-500 rounded">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>