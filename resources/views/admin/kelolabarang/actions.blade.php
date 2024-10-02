<div class="flex justify-center items-center gap-2">
    <button type="button" data-modal-target="edit{{ $data->id }}" data-modal-toggle="edit{{ $data->id }}"
        class="py-1 px-2 bg-yellow-400 rounded text-sm text-white flex items-center">
        <i class="bi bi-pencil-square"></i>
    </button>
    <form id="delete-form-{{ $data->id }}" action="{{ route('admin.barang.hapus', $data->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete({{ $data->id }})"
            class="py-1 px-2 bg-red-500 rounded text-sm text-white flex items-center">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>
