<header class="bg-gradient-to-r from-secondary to-primary text-white shadow-md">
    <div class="flex items-center justify-between px-4 md:px-8 py-5 mx-auto">
        <div class="flex">
            <button @click="sidebarOpen = !sidebarOpen" type="button" class=" focus:outline-none cursor-pointer"
                aria-label="Toggle sidebar">
                <i class="fas fa-bars fa-lg text-slate-200 hover:text-white"></i>
            </button>
        </div>

        <div class="flex-1 flex justify-center md:justify-start ml-4">
            <a href="{{ route('admin.dashboard.index') }}" class="bold text-2xl flex items-center">
                <span class="hidden md:block text-text-inverted">Admin Panel</span>
            </a>
        </div>

        <div class="relative ml-3">
            <div>
                @php
                    $user = Auth::user();
                    $profilePicture = $user->profile_picture_url ?? null;
                @endphp
                <a href=""
                    class="font-sans font-medium cursor-pointer hover:text-text-muted {{ request()->routeIs('profile.index') ? ' text-accent-active' : ' text-text-inverted' }} transition-colors duration-300 ease-in-out flex items-center">
                    @if ($profilePicture)
                        <img src="{{ $profilePicture }}" alt="{{ $user->username }}'s profile picture"
                            class="h-8 w-8 rounded-full object-cover">
                    @else
                        <i class="fas fa-user-circle fa-2x text-text-inverted"></i>
                    @endif
                </a>
            </div>
        </div>
    </div>
</header>
