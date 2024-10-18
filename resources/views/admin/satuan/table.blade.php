<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-center text-gray-500 display dark:text-gray-400" style="100%" id="data-satuan">
        <thead class="uppercase text-cen-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama Satuan
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($satuan as $data)
                <tr>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->satuan }}
                    </td>
                    <td scope="col" class="flex items-center justify-center gap-2 px-6 py-3">
                        <div>
                            <form id="delete-form-{{ $data->id }}"
                                action="{{ route('data-satuan.hapus', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $data->id }})"
                                    class="flex items-center px-2 py-2 text-sm text-white bg-red-500 rounded">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>