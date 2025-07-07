<x-admin-layout title="Edit Article">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Article:
                {{ $article->title }}</h1>
            <div class="flex space-x-2">
                <x-ui.link-button href="{{ route('admin.articles.show', $article) }}">
                    Detail
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.articles.index') }}">
                    Back
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" class="space-y-4"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-ui.input label="Judul Article" name="title" value="{{ old('title', $article->title) }}"
                        placeholder="Masukkan judul article" required />

                    <x-ui.dropdown label="Status" name="status" required>
                        <option value="">Choose Status</option>
                        @foreach ($status as $value)
                            <option value="{{ $value }}"
                                {{ old('status', $article->status) === $value ? 'selected' : '' }}>
                                {{ ucfirst($value) }}
                            </option>
                        @endforeach
                    </x-ui.dropdown>

                    <x-ui.dropdown label="Category" name="category_id" required>
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-ui.dropdown>
                </div>

                <!-- Current Featured Image -->
                @if ($article->featured_image_url)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Current Featured Image
                        </label>
                        <img src="{{ asset('storage/' . $article->featured_image_url) }}" alt="Current featured image"
                            class="w-32 h-32 object-cover rounded-lg shadow-sm">
                    </div>
                @endif

                <x-ui.file-input name="featured_image" label="Featured Image (Upload new to replace)" accept="image/*"
                    helpText="Upload a square image for best results. Max size: 2MB. Leave empty to keep current image." />

                <x-ui.textarea label="Excerpt" name="excerpt" value="{{ old('excerpt', $article->excerpt) }}"
                    placeholder="Masukkan deskripsi singkat article (opsional)" />

                <x-ui.wysiwyg-editor label="Content" name="content" value="{{ old('content', $article->content) }}"
                    required />

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Available Tags
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mt-1">
                        @forelse ($tags as $tag)
                            @php
                                $isChecked = in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray()));
                            @endphp
                            <x-ui.checkbox name="tags[]" value="{{ $tag->id }}" :checked="$isChecked"
                                :label="$tag->name" labelPosition="side" />
                        @empty
                            <div class="col-span-3 py-2 px-3 bg-gray-50 rounded text-gray-500">
                                Tags not available
                            </div>
                        @endforelse
                    </div>

                    @error('tags')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}</p>
                    @enderror
                    @error('tags.*')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}</p>
                    @enderror
                </div>

                <!-- Article Information -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Article Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Created:</span>
                            {{ $article->created_at->format('d F Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">Last Updated:</span>
                            {{ $article->updated_at->format('d F Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">Views:</span>
                            {{ number_format($article->views_count) }}
                        </div>
                        @if ($article->published_at)
                            <div>
                                <span class="font-medium">Published:</span>
                                {{ $article->published_at->format('d F Y H:i') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <x-ui.button type="submit">Save Changes</x-ui.button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
