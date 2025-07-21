<!-- NAVBAR -->
<nav class="bg-white p-4">
    <div class="container mx-auto items-center justify-between font-semibold">
        <div class="mx-4 flex justify-between space-y-2">
            <div class="flex space-x-4">
                <!-- Logo -->
                <div>logo</div>

                <!-- Searchbar -->
                <form action="{{ url()->current() }}" method="GET" class="flex items-center space-x-2">
                    <input type="text" name="search" placeholder="Search news..." value="{{ request('search') }}"
                        class="rounded-full border border-gray-300 w-68 px-4 py-1.5 text-sm focus:outline-orange-300" />
                    <button type="submit"
                        class="cursor-pointer rounded-full bg-orange-500 px-4 py-1.5 text-sm font-semibold text-white transition">Search</button>
                    {{-- Keep category param if present --}}
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                </form>
            </div>

            {{-- Auth Button --}}
            {{-- jika belum login --}}
            @guest
                <div class="space-x-2">
                    <a href="{{ route('login') }}" class="hover:text-orange-500">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-orange-500">Register</a>
                </div>
            @endguest

            {{-- Profile Button --}}
            {{-- jika sudah login --}}
            @auth

                <div class="space-x-2">

                    @if (auth()->user()->role === 'author')
                        <a href="{{ route('user.articles.index') }}" class="hover:text-orange-500">Dashboard</a>
                    @endif

                    <div class="relative inline-block text-left" id="dropdownContainer">
                        <button onclick="toggleMenu()"
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none cursor-pointer">
                            <img src="{{ auth()->user()->profile_picture_url ?? 'https://i.pravatar.cc/120' }}"
                                alt="Profile" class="rounded-full" />
                        </button>

                        <div id="menu"
                            class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                            <ul class="py-1">
                                <li><a href="{{ route('profile', auth()->user()->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleMenu() {
                        const menu = document.getElementById("menu");
                        menu.classList.toggle("hidden");
                    }

                    document.addEventListener("click", function(event) {
                        const container = document.getElementById("dropdownContainer");
                        const menu = document.getElementById("menu");
                        if (!container.contains(event.target)) {
                            menu.classList.add("hidden");
                        }
                    });
                </script>
            @endauth

        </div>

        <!-- Category -->
        <ul class="flex space-x-6 text-black">
            {{ $slot }}
        </ul>
    </div>

    {{-- Horizontal Line --}}
    <hr class="border-gray-300">
</nav>
