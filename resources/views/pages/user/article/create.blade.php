<x-layouts.app title="Tambah Artikel">
    <div class="max-w-2xl mx-auto mt-10 bg-white rounded shadow p-8">
        <h1 class="text-xl font-bold mb-6">Tambah Artikel</h1>
        <form action="{{ route('user.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Judul</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required value="{{ old('title') }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Kategori</label>
                <select name="category_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Tag</label>
                <div class="flex flex-wrap gap-4">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'checked' : '' }}
                                class="form-checkbox text-orange-500">
                            <span class="ml-2">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Gambar Utama</label>
                <input type="file" name="featured_image_url" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Excerpt</label>
                <textarea name="excerpt" class="w-full border rounded px-3 py-2" required>{{ old('excerpt') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Isi Artikel</label>
                <textarea name="content" class="w-full border rounded px-3 py-2" rows="8" required>{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Simpan</button>
            <a href="{{ route('user.articles.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
</x-layouts.app>
