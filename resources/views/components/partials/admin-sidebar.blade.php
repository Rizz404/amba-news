<div x-cloak class="fixed inset-y-0 left-0 z-40 w-64 bg-secondary shadow-lg transform" x-show="sidebarOpen"
    @keydown.escape.window="sidebarOpen = false" @click.away="sidebarOpen = false" {{-- Closes sidebar if clicked outside, on any screen size --}}
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
    <div class="flex flex-col flex-grow h-full">
        <div class="flex items-center flex-shrink-0 px-4 pt-4">
            <a href="{{ route('admin.dashboard.index') }}" class="flex items-center">
                <span class="text-xl font-bold text-text-inverted font-sans">Admin
                    Panel</span>
            </a>
            <button @click="sidebarOpen = false"
                class="ml-auto lg:hidden text-text-inverted hover:text-text-inverted focus:outline-none"
                aria-label="Close sidebar">
                <i class="fas fa-times fa-lg"></i>
            </button>
        </div>

        <nav class="flex-1 mt-6 px-2 space-y-1 overflow-y-auto pb-4">
            {{-- * Dashboard --}}
            <a href="{{ route('admin.dashboard.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard.index') ? 'bg-primary-active text-text-inverted' : 'text-text-inverted hover:bg-primary-active hover:text-text-inverted' }}">
                <i
                    class="fa-solid fa-gauge mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard.index') ? 'text-text-inverted' : 'text-text-muted group-hover:text-text-inverted' }}"></i>
                Dashboard
            </a>
            {{-- * Categories --}}
            <a href="{{ route('admin.categories.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.categories.index') ? 'bg-primary-active text-text-inverted' : 'text-text-inverted hover:bg-primary-active hover:text-text-inverted' }}">
                <i
                    class="fa-solid fa-list mr-3 h-5 w-5 {{ request()->routeIs('admin.categories.index') ? 'text-text-inverted' : 'text-text-muted group-hover:text-text-inverted' }}"></i>
                Catagories
            </a>
            {{-- * Tags --}}
            <a href="{{ route('admin.tags.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.tags.index') ? 'bg-primary-active text-text-inverted' : 'text-text-inverted hover:bg-primary-active hover:text-text-inverted' }}">
                <i
                    class="fa-solid fa-tag mr-3 h-5 w-5 {{ request()->routeIs('admin.tags.index') ? 'text-text-inverted' : 'text-text-muted group-hover:text-text-inverted' }}"></i>
                Tags
            </a>
            {{-- * Articles --}}
            <a href="{{ route('admin.articles.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.articles.index') ? 'bg-primary-active text-text-inverted' : 'text-text-inverted hover:bg-primary-active hover:text-text-inverted' }}">
                <i
                    class="fa-solid fa-newspaper mr-3 h-5 w-5 {{ request()->routeIs('admin.articles.index') ? 'text-text-inverted' : 'text-text-muted group-hover:text-text-inverted' }}"></i>
                Articles
            </a>
        </nav>

        <div class="flex-shrink-0 mt-auto border-t border-secondary-active p-4">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="group flex items-center px-4 py-2 text-sm font-medium rounded-md text-text-inverted hover:bg-primary hover:text-text-inverted w-full transition duration-150 ease-in-out cursor-pointer">
                    <i class="fas fa-sign-out-alt mr-3 h-5 w-5 text-text-muted group-hover:text-text-inverted"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
