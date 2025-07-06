<x-admin-layout title="Create Article">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Create Article</h1>
            <div class="flex space-x-2">
                <x-ui.link-button href="{{ route('admin.articles.index') }}">
                    Kembali
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.articles.store') }}" method="POST" class="space-y-4"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.input label="Nama Article" name="title" value="{{ old('title') }}"
                            placeholder="Masukkan nama article" required />

                        <x-ui.dropdown label="Status" name="status" required>
                            <option value="">Choose Status</option>
                            @foreach ($status as $value)
                                <option value="{{ $value }}" {{ old('status') === $value ? 'selected' : '' }}>
                                    {{ ucfirst($value) }}
                                </option>
                            @endforeach
                        </x-ui.dropdown>

                        <x-ui.dropdown label="Category" name="category_id" required>
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') === $category ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-ui.dropdown>
                    </div>

                    <x-ui.file-input name="featured_image" label="Featured Image" accept="image/*"
                        helpText="Upload a square image for best results. Max size: 2MB" />

                    <x-ui.textarea label="Excerpt" name="excerpt" value="{{ old('excerpt') }}"
                        placeholder="Masukkan deskripsi singkat article (opsional)" />

                    <x-ui.textarea label="Content" name="content" value="{{ old('content') }}"
                        placeholder="Input content article" />

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Jurusan Kuliah yang Tersedia
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mt-1">
                            @forelse ($tags as $tag)
                                <x-ui.checkbox name="tags[]" value="{{ $tag->id }}" :checked="in_array($tag->id, old('tags', []))"
                                    :label="$tag->name" labelPosition="side" />
                            @empty
                                <div class="col-span-3 py-2 px-3 bg-gray-50 rounded text-gray-500">
                                    Tags not available
                                </div>
                            @endforelse
                        </div>

                        @error('tags')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}</p>
                        @enderror
                        @error('tags.*')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Simpan</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
