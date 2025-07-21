<x-layouts.app title="Profile">
    <div class="max-w-xl mx-auto mt-10">
        <a href="{{ route('landing') }}"
           class="inline-block mb-4 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">
            &larr; Kembali
        </a>
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex flex-col items-center">
                <img src="{{ auth()->user()->profile_picture_url ?? 'https://i.pravatar.cc/120' }}"
                     alt="Profile Picture"
                     class="w-28 h-28 rounded-full object-cover mb-4 border-2 border-orange-400">
                <h2 class="text-2xl font-bold mb-2">{{ auth()->user()->username }}</h2>
                <p class="text-gray-600 mb-1">{{ auth()->user()->email }}</p>
                <span class="inline-block bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
                @if(auth()->user()->role === 'user')
                    <form action="{{ route('profile.upgrade-role', auth()->user()->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                            Upgrade ke Author
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
