<x-layouts.app title="{{ $article->title }}">
    {{-- NAVBAR --}}
    <x-partials.user-navbar></x-partials.user-navbar>

    {{-- CONTENT --}}
    <div class="container mx-auto max-w-3xl py-8">
        <a href="{{ route('landing') }}"
            class="inline-block mb-4 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-sm text-gray-700">
            < Kembali
        </a>
        <article class="bg-white rounded shadow p-6">
            <h1 class="text-3xl font-bold mb-2">{{ $article->title }}</h1>
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <span>By {{ $article->user->name ?? '-' }}</span>
                <span class="mx-2">|</span>
                <span>Kategori: {{ $article->category->name ?? '-' }}</span>
                <span class="mx-2">|</span>
                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</span>
                <span class="mx-2">|</span>
                <span>{{ $article->views_count }} views</span>
            </div>
            @if ($article->featured_image_url)
                <img src="{{ asset('storage/' . $article->featured_image_url) }}" alt="Featured Image"
                    class="w-full rounded mb-6">
            @endif
            <div class="prose max-w-none mb-6">
                {!! $article->content !!}
            </div>
            @if ($article->tags->count())
                <div class="mt-4">
                    <span class="font-semibold">Tags:</span>
                    @foreach ($article->tags as $tag)
                        <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-2">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif
        </article>
    </div>
</x-layouts.app>
