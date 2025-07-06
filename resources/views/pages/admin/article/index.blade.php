<x-admin-layout title="Articles">
    <div class="container px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Articles List</h1>
            <div class="flex space-x-2">
                <form action="{{ route('admin.articles.index') }}" method="GET" class="flex space-x-2">
                    <x-ui.searchbar name="search" placeholder="Cari article..." value="{{ request('search') }}" />

                    <x-ui.button type="submit">
                        Cari
                    </x-ui.button>
                </form>
                <x-ui.link-button href="{{ route('admin.articles.create') }}">
                    Tambah
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-teto-cream">
                <thead class="bg-teto-cream">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Image
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Title
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Category
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Views Count
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Published At
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-teto-cream">
                    @forelse ($articles as $article)
                        <tr onclick="window.location='{{ route('admin.articles.show', $article) }}'"
                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if ($article->featured_image_url)
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ $article->featured_image_url }}" alt="{{ $article->title }}">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-full bg-teto-cream flex items-center justify-center">
                                            <span class="text-teto-dark-text text-xs">No Image</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-teto-dark-text">
                                    {{ $article->title }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-teto-dark-text">
                                    {{ $article->category->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                {{ !$article->status === 'negeri' ? 'bg-teto-light' : 'bg-teto-soft-teal' }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">
                                    {{ $article->views_count }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">
                                    {{ $article->published_at }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-teto-dark-text">
                                Article not found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
</x-admin-layout>
