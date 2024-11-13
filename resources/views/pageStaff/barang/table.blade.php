<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-gray-500 dark:text-gray-400 display" style="100%" id="data-barang">
        <thead class="uppercase text-cen-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Kategori
                </th>
                <th scope="col" class="px-6 py-3">
                    Kondisi
                </th>
                <th scope="col" class="px-6 py-3">
                    Stock
                </th>
                <th scope="col" class="px-6 py-3">
                    Satuan
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $data)
                <tr>
                    <td scope="col" class="px-6 py-3">
                        {{ $loop->iteration }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->nama_barang }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->kategori->kategori }}
                    </td>
                    <td scope="col" class="px-6 py-3 text-center">
                        @if ($data->stock->stock == 0)
                            <p class="p-1 text-white bg-red-500 rounded-lg">Habis</p>
                        @elseif ($data->stock->stock > 0 && $data->is_stock_reduced)
                            <p class="p-1 text-white bg-yellow-500 rounded-lg">Terpakai</p>
                        @elseif ($data->stock->stock > 0 && $data->is_stock_lost)
                            <p class="p-1 text-white bg-gray-500 rounded-lg">Hilang</p>
                        @else
                            <p class="p-1 text-white bg-green-500 rounded-lg">Baik</p>
                        @endif
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->stock->stock }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $data->satuan->satuan }}
                    </td>
                    <td scope="col" class="flex items-center justify-center gap-2 px-6 py-3">
                        <div>
                            <button type="button" data-modal-target="detail{{ $data->id }}"
                                data-modal-toggle="detail{{ $data->id }}"
                                class="flex items-center px-2 py-2 text-sm text-white bg-yellow-400 rounded">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <div>
                            <form id="delete-form-{{ $data->id }}"
                                action="{{ route('data-barang.hapus', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $data->id }})"
                                    class="flex items-center px-2 py-2 text-sm text-white bg-red-500 rounded">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div>
                            <button type="button" data-modal-target="edit{{ $data->id }}"
                                data-modal-toggle="edit{{ $data->id }}"
                                class="flex items-center px-2 py-2 text-sm text-white bg-blue-500 rounded">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                @include('pageStaff.barang.modal.detail')

                @include('pageStaff.barang.modal.edit')
            @endforeach
        </tbody>
    </table>
</div>
