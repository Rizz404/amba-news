<x-admin-layout title="Create Category">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Create Category</h1>
            <x-ui.link-button href="{{ route('admin.categories.index') }}">
                Back
            </x-ui.link-button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <x-ui.input label="Category Name" name="name" value="{{ old('name') }}"
                        placeholder="Input category name" required />

                    <x-ui.textarea label="Description" name="description" value="{{ old('description') }}"
                        placeholder="Input category description" />

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Save</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
