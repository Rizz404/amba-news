<x-layouts.app title="Home">
    {{-- NAVBAR --}}
    <x-partials.user-navbar>
        {{-- Default Home category --}}
        <li>
            <a href="{{ url()->current() }}"
               class="hover:text-orange-500 {{ !request('category') ? 'text-orange-500 font-bold' : '' }}">
                Home
            </a>
        </li>
        @foreach ($categories as $category)
            <li>
                <a href="{{ url()->current() }}?category={{ $category->id }}"
                   class="hover:text-orange-500 {{ request('category') == $category->id ? 'text-orange-500 font-bold' : '' }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </x-partials.user-navbar>

    @php
        // Filter by category (id) or show all by created_at
        $filteredArticles = request('category')
            ? $articles->where('category_id', request('category'))
            : $articles->sortByDesc('created_at');

        // Filter by search if present
        if(request('search')) {
            $filteredArticles = $filteredArticles->filter(function($article) {
                $search = strtolower(request('search'));
                return str_contains(strtolower($article->title), $search)
                    || str_contains(strtolower($article->excerpt), $search);
            });
        }
    @endphp

    @if ($filteredArticles->isEmpty())
        <div class="text-center p-4">
            <h2 class="text-2xl font-bold text-gray-800">Tidak ada artikel yang tersedia</h2>
            <p class="text-gray-600">Silakan kembali lagi nanti.</p>
        </div>
    @else
        {{-- CONTENT --}}
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-2 p-4 px-66 lg:grid-cols-3">
            {{-- Kolom Kiri: Daftar Berita --}}
            <div class="space-y-6 lg:col-span-2">

                @php
                    $newestArticle = $filteredArticles->sortByDesc('published_at')->first();
                @endphp

                {{-- Card 1: Gambar overlay teks --}}
                <a href="{{ route('articles.show', $newestArticle->id) }}" class="mx-auto block w-full max-w-md">
                    <div
                        class="relative w-full overflow-hidden rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg">
                        <img src="{{ asset('storage/' . $newestArticle->featured_image_url) }}" alt="Gambar Berita"
                            class="h-56 w-full object-cover" />
                        <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-transparent px-4 py-3">
                            <h3 class="text-xl font-semibold text-white drop-shadow-sm">{{ $newestArticle->title }}</h3>
                            <p class="text-sm text-white drop-shadow-sm">{{ $newestArticle->excerpt }}</p>
                        </div>
                    </div>
                </a>

                @forelse ($filteredArticles as $article)
                    {{-- Card 2: Gambar di kiri, teks di kanan --}}
                    <a href="{{ route('articles.show', $article->id) }}" class="mx-auto block w-full max-w-md">
                        <div
                            class="flex w-full overflow-hidden rounded-lg bg-white shadow-md transition-shadow duration-300 hover:shadow-lg">
                            <img src="{{ asset('storage/' . $article->featured_image_url) }}" alt="Gambar"
                                class="h-auto w-40 object-cover" />
                            <div class="flex flex-col justify-center p-4">
                                <h3 class="mb-2 text-lg font-bold text-gray-800">{{ $article->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $article->excerpt }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center text-gray-500">
                        <p>Tidak ada artikel yang tersedia.</p>
                    </div>
                @endforelse

                {{-- Card 3: Gambar di atas, teks di bawah --}}
                {{-- <a href="" class="mx-auto block w-full max-w-md">
                <div
                    class="w-full overflow-hidden rounded-lg bg-white shadow-md transition-shadow duration-300 hover:shadow-lg">
                    <img src="{{ asset($article->featured_image_url) }}" alt="Gambar Card"
                        class="h-48 w-full object-cover" />
                    <div class="p-4">
                        <h3 class="mb-2 text-lg font-bold text-gray-800">{{ $article->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $article->excerpt }}</p>
                    </div>
                </div>
            </a> --}}
            </div>

            {{-- Kolom Kanan: Info Tambahan --}}
            <div class="space-y-4">
                <div class="rounded-lg bg-white p-4 shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">Trending Saat Ini</h3>
                    <ul class="list-inside list-disc space-y-1 text-gray-700">
                        @foreach ($articles->sortByDesc('views')->sortByDesc('published_at')->take(4) as $trending)
                            <li>
                                <a href="{{ route('articles.show', $trending->id) }}" class="hover:text-orange-500">
                                    {{ $trending->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- <div class="rounded-lg bg-white p-4 shadow-md">
                    <h3 class="mb-2 text-lg font-bold text-gray-800">Kategori Populer</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded bg-indigo-100 px-2 py-1 text-sm text-indigo-700">Hot</span>
                        <span class="rounded bg-green-100 px-2 py-1 text-sm text-green-700">Tekno</span>
                        <span class="rounded bg-yellow-100 px-2 py-1 text-sm text-yellow-700">Bola</span>
                    </div>
                </div> --}}
            </div>
        </div>
    @endif

</x-layouts.app>
