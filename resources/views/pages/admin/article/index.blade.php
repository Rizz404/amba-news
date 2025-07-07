<x-admin-layout title="Articles">
    <div class="container px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Articles List</h1>
            <div class="flex space-x-2">
                <form action="{{ route('admin.articles.index') }}" method="GET" class="flex space-x-2">
                    <x-ui.searchbar name="search" placeholder="Search article..." value="{{ request('search') }}" />

                    <x-ui.button type="submit">
                        Search
                    </x-ui.button>
                </form>
                <x-ui.link-button href="{{ route('admin.articles.create') }}">
                    Tambah
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-bg-muted">
                <thead class="bg-bg-alt">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Views Count
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Published At
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-bg-muted">
                    @forelse ($articles as $article)
                        <tr onclick="window.location='{{ route('admin.articles.show', $article) }}'"
                            class="hover:bg-bg-alt cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if ($article->featured_image_url)
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ asset('storage/' . $article->featured_image_url) }}"
                                            alt="{{ $article->title }}">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-full bg-bg-muted flex items-center justify-center">
                                            <span class="text-text-muted text-xs">No Image</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-text-primary">
                                    {{ $article->title }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-text-primary">
                                    {{ $article->category->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClass = '';
                                    switch ($article->status) {
                                        case 'published':
                                            $statusClass = 'bg-green-100 text-green-800';
                                            break;
                                        case 'draft':
                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'pending':
                                            $statusClass = 'bg-blue-100 text-blue-800';
                                            break;
                                        default:
                                            $statusClass = 'bg-gray-100 text-gray-800';
                                    }
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-text-primary">
                                    {{ $article->views_count }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-text-primary">
                                    {{ $article->published_at }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-text-primary">
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
