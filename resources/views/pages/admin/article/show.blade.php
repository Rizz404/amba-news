<x-admin-layout title="Detail Article">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detail Article</h1>
            <div class="flex space-x-2">
                <x-ui.link-button href="{{ route('admin.articles.index') }}">
                    Kembali
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.articles.edit', $article) }}">
                    Edit
                </x-ui.link-button>
                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus article ini?')">
                    @csrf
                    @method('DELETE')
                    <x-ui.button type="submit" class="bg-red-500 hover:bg-red-600">
                        Hapus
                    </x-ui.button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="p-6">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4 flex justify-center mb-6 md:mb-0">
                        @if ($article->logo)
                            <img class="h-40 w-40 object-contain" src="{{ $article->logo }}" alt="{{ $article->name }}">
                        @else
                            <div class="h-40 w-40 rounded-lg bg-gray-200 flex items-center justify-center">
                                <span class="text-teto-dark-text">No Logo</span>
                            </div>
                        @endif
                    </div>

                    <div class="md:w-3/4 md:pl-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">
                                    {{ $article->name }}</h2>
                                <div class="flex items-center mt-2">
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $article->status === 'negeri' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }} mr-2">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $article->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $article->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-xl font-medium text-gray-900 mr-2">
                                    {{ $article->rating }}
                                </div>
                                <div class="flex text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($article->rating))
                                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                </path>
                                            </svg>
                                        @elseif($i - 0.5 <= $article->rating)
                                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                </path>
                                                <path fill="#e5e7eb" d="M12 17.27V5 17.27z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5 fill-current text-gray-300" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                </path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Lokasi
                                </p>
                                <p class="font-medium">
                                    {{ $article->city }},
                                    {{ $article->province }}
                                </p>
                            </div>

                            @if ($article->website)
                                <div>
                                    <p class="text-sm text-teto-dark-text">
                                        Website</p>
                                    <a href="{{ $article->website }}" target="_blank"
                                        class="text-blue-600 hover:underline font-medium">
                                        {{ $article->website }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        @if ($article->description)
                            <div class="mt-4">
                                <p class="text-sm text-teto-dark-text">Deskripsi
                                </p>
                                <div class="bg-teto-cream rounded-md p-3 mt-1">
                                    <p class="text-sm text-gray-700 ">
                                        {{ $article->description }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Daftar Jurusan Tersedia</h3>
            </div>

            <div class="p-6">
                @if ($article->collegeMajors->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($article->collegeMajors as $major)
                            <div
                                class="border border-gray-200 rounded-lg p-4 hover:bg-teto-cream-hover transition-colors">
                                <div class="flex justify-between">
                                    <h4 class="font-medium text-gray-900">
                                        {{ $major->major_name }}</h4>
                                    <a href="{{ route('admin.college-majors.show', $major) }}"
                                        class="text-blue-600 hover:underline text-sm">
                                        Detail
                                    </a>
                                </div>
                                @if ($major->faculty)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Fakultas: {{ $major->faculty }}</p>
                                @endif
                                @if ($major->field_of_study)
                                    <p class="text-sm text-gray-600">Bidang:
                                        {{ $major->field_of_study }}</p>
                                @endif
                                @if ($major->description)
                                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                        {{ Str::limit($major->description, 100) }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-teto-dark-text">
                        Belum ada jurusan yang terdaftar untuk article ini.
                    </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-teto-cream border-t border-gray-200 flex justify-between items-center">
                <span class="text-sm text-gray-600">Total:
                    {{ $article->collegeMajors->count() }} jurusan</span>
                <x-ui.link-button href="{{ route('admin.college-majors.create', $article) }}" size="sm">
                    Tambah Jurusan
                </x-ui.link-button>
            </div>
        </div>

        <div class="mt-6 text-sm text-teto-dark-text">
            <div class="flex justify-between">
                <div>
                    <p>Dibuat pada:
                        {{ $article->created_at->format('d F Y H:i') }}</p>
                    <p>Diperbarui pada:
                        {{ $article->updated_at->format('d F Y H:i') }}</p>
                </div>
                @if ($article->deleted_at)
                    <div>
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                            Dihapus pada:
                            {{ $article->deleted_at->format('d F Y H:i') }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
