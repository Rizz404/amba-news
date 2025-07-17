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
                <a href="#" class="hover:text-orange-500">Register</a>
            </div>
        </div>

        <!-- Category -->
        <ul class="flex space-x-6 text-black">
            <li><a href="#" class="hover:text-orange-500">Home</a></li>
            <li><a href="#" class="hover:text-orange-500">News</a></li>
            <li><a href="#" class="hover:text-orange-500">Sus</a></li>
            <li><a href="#" class="hover:text-orange-500">Football</a></li>
            <li><a href="#" class="hover:text-orange-500">TV</a></li>
            <li><a href="#" class="hover:text-orange-500">Technology</a></li>
        </ul>
    </div>

    {{-- Horizontal Line --}}
    <hr class="border-gray-300">
</nav>
<!-- END NAVBAR -->
