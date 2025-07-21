<x-layouts.app title="Artikel Saya">
    <div class="max-w-4xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Artikel Saya</h1>
            <a href="{{ route('user.articles.create') }}"
               class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">+ Tambah Artikel</a>
        </div>
        <table class="w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left">Judul</th>
                    <th class="py-2 px-4 text-left">Kategori</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $article->title }}</td>
                        <td class="py-2 px-4">{{ $article->category->name ?? '-' }}</td>
                        <td class="py-2 px-4">{{ $article->status ?? 'draft' }}</td>
                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('user.articles.edit', $article->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Edit</a>
                            <form action="{{ route('user.articles.destroy', $article->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
