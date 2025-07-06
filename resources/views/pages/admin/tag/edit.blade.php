<x-admin-layout title="Edit Category">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Category</h1>
            <div class=" flex space-x-2">
                <x-ui.link-button href="{{ route('admin.categories.show', $category) }}">
                    Detail
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.categories.index') }}">
                    Kembali
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-ui.input label="Nama Kriteria" name="name" value="{{ old('name', $category->name) }}"
                        placeholder="Masukkan nama kriteria" required />

                    <input type="hidden" name="is_active" value="0">

                    <x-ui.textarea label="Deskripsi" name="description"
                        value="{{ old('description', $category->description) }}" />

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Simpan Data</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
