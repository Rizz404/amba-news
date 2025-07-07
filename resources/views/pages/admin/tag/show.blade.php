<x-admin-layout title="Tag Details">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Tag Details</h1>
            <div class="flex space-x-2">
                <x-ui.link-button href="{{ route('admin.tags.index') }}">
                    Back
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.tags.edit', $tag) }}">
                    Edit
                </x-ui.link-button>
                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST"
                    onsubmit="return confirm('Are u sure wanna delete dis tag?')">
                    @csrf
                    @method('DELETE')
                    <x-ui.button type="submit" class="bg-red-500 hover:bg-red-600">
                        Hapus
                    </x-ui.button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-text-primary">
                                    Name
                                </p>
                                <p class="font-medium">{{ $tag->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-text-primary">Tanggal
                                    Dibuat
                                </p>
                                <p class="font-medium">
                                    {{ $tag->created_at->format('d F Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-text-primary">Terakhir
                                    Diperbarui</p>
                                <p class="font-medium">
                                    {{ $tag->updated_at->format('d F Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
