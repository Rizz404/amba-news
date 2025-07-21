<x-layouts.app title="Edit Artikel">
    <div class="max-w-2xl mx-auto mt-10 bg-white rounded shadow p-8">
        <h1 class="text-xl font-bold mb-6">Edit Artikel</h1>
        <form action="{{ route('user.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Judul</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required value="{{ old('title', $article->title) }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Kategori</label>
                <select name="category_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $article->category_id) == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Gambar Utama</label>
                @if($article->featured_image_url)
                    <img src="{{ asset('storage/' . $article->featured_image_url) }}" class="w-32 mb-2 rounded">
                @endif
                <input type="file" name="featured_image_url" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Excerpt</label>
                <textarea name="excerpt" class="w-full border rounded px-3 py-2" required>{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Isi Artikel</label>
                <textarea name="content" class="w-full border rounded px-3 py-2" rows="8" required>{{ old('content', $article->content) }}</textarea>
            </div>
            <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Update</button>
            <a href="{{ route('user.articles.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
</x-layouts.app>
