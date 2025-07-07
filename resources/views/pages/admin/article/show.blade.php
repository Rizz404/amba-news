<x-admin-layout title="Detail Article">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detail Article</h1>
            <div class="flex space-x-2">
                <x-ui.link-button href="{{ route('admin.articles.index') }}">
                    Back
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.articles.edit', $article) }}">
                    Edit
                </x-ui.link-button>
                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus article ini?')">
                    @csrf
                    @method('DELETE')
                    <x-ui.button type="submit" class="bg-red-500 hover:bg-red-600">
                        Hapus
                    </x-ui.button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="p-6">
                <div class="flex flex-col">
                    {{-- * Article Header --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h2 class="text-3xl font-bold text-gray-800 mb-2">
                                    {{ $article->title }}
                                </h2>
                                <p class="text-gray-600 text-sm mb-3">
                                    Slug: <span
                                        class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $article->slug }}</span>
                                </p>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                <span
                                    class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                    {{ $article->status === 'published'
                                        ? 'bg-green-100 text-green-800'
                                        : ($article->status === 'draft'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-blue-100 text-blue-800') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">{{ number_format($article->views_count) }} views</span>
                                </div>
                            </div>
                        </div>

                        {{-- * Featured Image --}}
                        @if ($article->featured_image_url)
                            <div class="mb-6">
                                <img class="w-full h-64 object-cover rounded-lg shadow-sm"
                                    src="{{ asset('storage/' . $article->featured_image_url) }}"
                                    alt="{{ $article->title }}">
                            </div>
                        @endif

                        {{-- * Article Meta Info --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-text-primary">Penulis</p>
                                <p class="font-medium">{{ $article->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-text-primary">Kategori</p>
                                <p class="font-medium">{{ $article->category->name }}</p>
                            </div>
                            @if ($article->published_at)
                                <div>
                                    <p class="text-sm text-text-primary">Dipublikasikan</p>
                                    <p class="font-medium">{{ $article->published_at->format('d F Y H:i') }}</p>
                                </div>
                            @endif
                        </div>

                        {{-- * Excerpt --}}
                        @if ($article->excerpt)
                            <div class="mb-6">
                                <p class="text-sm text-text-primary mb-2">Ringkasan</p>
                                <div class="bg-bg-alt rounded-lg p-4">
                                    <p class="text-gray-700 italic">{{ $article->excerpt }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- * Article Content --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Konten Article</h3>
            </div>
            <div class="p-6">
                <div class="prose max-w-none">
                    {!! $article->content !!}
                </div>
            </div>
        </div>

        {{-- * Article Statistics --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Statistik Article</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ number_format($article->views_count) }}</div>
                        <div class="text-sm text-text-primary">Total Views</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">
                            {{ str_word_count(strip_tags($article->content)) }}</div>
                        <div class="text-sm text-text-primary">Jumlah Kata</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">
                            {{ ceil(str_word_count(strip_tags($article->content)) / 200) }}</div>
                        <div class="text-sm text-text-primary">Menit Baca</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- * Timestamps --}}
        <div class="mt-6 text-sm text-text-primary">
            <div class="flex justify-between">
                <div>
                    <p>Dibuat pada: {{ $article->created_at->format('d F Y H:i') }}</p>
                    <p>Diperbarui pada: {{ $article->updated_at->format('d F Y H:i') }}</p>
                    @if ($article->published_at)
                        <p>Dipublikasikan pada: {{ $article->published_at->format('d F Y H:i') }}</p>
                    @endif
                </div>
                @if ($article->deleted_at)
                    <div>
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                            Dihapus pada: {{ $article->deleted_at->format('d F Y H:i') }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
