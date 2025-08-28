<header class="fixed top-0 w-full bg-white/60 backdrop-blur-md shadow-md z-40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="/icon.png" class="h-10 w-10">
            <span class="text-2xl font-bold text-[#87CBB9]">MicroLab Virtual</span>
        </div>

        <!-- Back button -->
        <a href="{{ url('/') }}"
            class="inline-flex items-center text-sm text-gray-700 font-semibold hover:text-[#87CBB9] transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
</header>