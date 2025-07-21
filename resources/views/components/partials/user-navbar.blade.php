<!-- NAVBAR -->
<nav class="bg-white p-4">
    <div class="container mx-auto items-center justify-between font-semibold">
        <div class="mx-4 flex justify-between space-y-2">
            <div class="flex space-x-4">
                <!-- Logo -->
                <div>logo</div>

                <!-- Searchbar -->
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Search news..."
                        class="rounded-full border border-gray-300 w-68 px-4 py-1.5 text-sm focus:outline-orange-300" />
                    <button
                        class="cursor-pointer rounded-full bg-orange-500 px-4 py-1.5 text-sm font-semibold text-white transition">Search</button>
                </div>
            </div>

            <!-- Auth Button -->
            <div class="space-x-2">
                <a href="{{ route('login') }}" class="hover:text-orange-500">Login</a>
                <a href="{{ route('register') }}" class="hover:text-orange-500">Register</a>
            </div>
        </div>
        
        @auth
<!-- Profile Dropdown -->
<div class="group relative">
    <!-- Tombol Profile -->
    <button class="flex items-center space-x-2 focus:outline-none">
        <img src="https://i.pravatar.cc/32" class="h-8 w-8 rounded-full" alt="Profile" />
          <span class="text-gray-700">Profile</span>
          <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <!-- Dropdown menu -->
        <div class="invisible absolute right-0 z-10 mt-2 w-48 rounded-md border bg-white opacity-0 shadow-lg transition-all duration-150 group-hover:visible group-hover:opacity-100">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
        </div>
    </div>
    @endauth
    
        <!-- Category -->
        <ul class="flex space-x-6 text-black">
            {{ $slot }}
        </ul>
    </div>

    {{-- Horizontal Line --}}
    <hr class="border-gray-300">
</nav>
