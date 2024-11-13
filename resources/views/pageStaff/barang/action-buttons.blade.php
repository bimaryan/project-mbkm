<div class="flex items-center justify-center gap-2">
    {{-- Tombol Detail --}}
    <div>
        <button type="button" data-modal-target="detail{{ $data->id }}" data-modal-toggle="detail{{ $data->id }}"
            class="flex items-center px-2 py-2 text-sm text-white bg-yellow-400 rounded">
            <i class="fa-solid fa-eye"></i>
        </button>
    </div>

    {{-- Tombol Hapus --}}
    <div>
        <form id="delete-form-{{ $data->id }}" action="{{ route('data-barang.hapus', $data->id) }}" method="POST"
            style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete({{ $data->id }})"
                class="flex items-center px-2 py-2 text-sm text-white bg-red-500 rounded">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    </div>

    {{-- Tombol Edit --}}
    <div>
        <button type="button" data-modal-target="edit{{ $data->id }}" data-modal-toggle="edit{{ $data->id }}"
            class="flex items-center px-2 py-2 text-sm text-white bg-blue-500 rounded">
            <i class="fa-solid fa-pen-to-square"></i>
        </button>
    </div>

    {{-- Modals --}}
    @include('pageStaff.barang.modal.detail', ['data' => $data])
    @include('pageStaff.barang.modal.edit', ['data' => $data])
</div>
