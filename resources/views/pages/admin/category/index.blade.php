<x-admin-layout title="Categories">
    <div class="container px-4 py-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold">Categories List</h1>
            <div>
                <form action="{{ route('admin.categories.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-2">

                    <x-ui.searchbar name="search" placeholder="Cari categories..." value="{{ request('search') }}" />

                    <x-ui.button type="submit"
                        class="bg-primary hover:bg-primary-hover text-white font-semibold rounded-md shadow-md transition ease-in-out duration-150">
                        Cari
                    </x-ui.button>

                    <x-ui.link-button href="{{ route('admin.categories.create') }}">
                        Tambah
                    </x-ui.link-button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">

            <table class="min-w-full divide-y divide-bg-main">
                <thead class="bg-bg-main">
                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Slug
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-text-primary uppercase tracking-wider">
                            Description
                        </th>

                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-bg-main">
                    @forelse ($categories as $category)
                        <tr onclick="window.location='{{ route('admin.categories.show', $category) }}'"
                            class="hover:bg-bg-alt cursor-pointer transition-colors duration-150">

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $category->slug }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $category->description }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-text-muted">

                                No categories found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-admin-layout>
