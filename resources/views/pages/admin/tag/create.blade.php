<x-admin-layout title="Create Tag">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Create Tag</h1>
            <x-ui.link-button href="{{ route('admin.tags.index') }}">
                Back
            </x-ui.link-button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.tags.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <x-ui.input label="Tag Name" name="name" value="{{ old('name') }}" placeholder="Input tag name"
                        required />

                    <x-ui.textarea label="Description" name="description" value="{{ old('description') }}"
                        placeholder="Input tag description" />

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Save</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
