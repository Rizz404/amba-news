<x-layouts.app title="Home">
    {{-- NAVBAR --}}
    <x-partials.user-navbar>
        @foreach ($categories as $category)
            <li><a href="#" class="hover:text-orange-500">{{ $category->name }}</a></li>
        @endforeach
    </x-partials.user-navbar>

    {{-- CONTENT --}}
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-2 p-4 px-66 lg:grid-cols-3">
        {{-- Kolom Kiri: Daftar Berita --}}
        <div class="space-y-6 lg:col-span-2">

            <?php
            $newestArticle = $articles->sortByDesc('published_at')->first();
            ?>

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

            @foreach ($articles as $article)
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
            @endforeach

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
                <h3 class="mb-2 text-lg font-bold text-gray-800">Trending Hari Ini</h3>
                <ul class="list-inside list-disc space-y-1 text-gray-700">
                    <li>Hasil Drawing Timnas Indonesia</li>
                    <li>Nikita Mirzani Sidang Lagi</li>
                    <li>Prediksi AFF U-23 2025</li>
                </ul>
            </div>

            <div class="rounded-lg bg-white p-4 shadow-md">
                <h3 class="mb-2 text-lg font-bold text-gray-800">Kategori Populer</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="rounded bg-indigo-100 px-2 py-1 text-sm text-indigo-700">Hot</span>
                    <span class="rounded bg-green-100 px-2 py-1 text-sm text-green-700">Tekno</span>
                    <span class="rounded bg-yellow-100 px-2 py-1 text-sm text-yellow-700">Bola</span>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
