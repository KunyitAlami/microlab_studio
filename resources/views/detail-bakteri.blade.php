<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Bakteri - MicroLab Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/icon.png" type="image/png">
    {{-- Import Alpine.js untuk interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Style untuk transisi akordion yang mulus */
        [x-cloak] {
            display: none !important;
        }

        .accordion-content {
            overflow: hidden;
            transition: max-height 0.4s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-100 font-[Poppins]">
    {{-- Konten Utama --}}
    <header class="dark:bg-gray-800 shadow-md sticky top-0 z-40">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="/icon.png" class="h-10 w-10 mr-3">
                <span class="text-2xl font-bold text-[#87CBB9]">MicroLab Virtual</span>
            </div>
            <a href="{{ url('/') }}" class="inline-flex items-center text-white hover:text-black font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </header>
    <main class="">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Gambar dan Penjelasan Bakteri --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="{{ asset($bakteri['gambar']) }}" alt="Gambar {{ $bakteri['nama'] }}" class="w-full h-auto object-cover rounded-md">
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $bakteri['nama'] }}</h1>
                    <p class="mt-4 text-gray-600 text-justify">
                        {{ $bakteri['deskripsi'] }}
                    </p>
                </div>
            </div>

            {{-- Kolom Kanan: Daftar Teknik Lab (Akordion Interaktif) --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-lg" x-data="{ open: 'goresan' }">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Pilih Teknik Inokulasi</h2>
                <div class="space-y-4">

                    {{-- Item Akordion 1: Inokulasi Goresan --}}
                    <div class="border rounded-lg overflow-hidden">
                        <button @click="open = (open === 'goresan' ? '' : 'goresan')" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100">
                            <span class="font-semibold text-lg">Inokulasi Padat Goresan (Streak Plate)</span>
                            <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open === 'goresan' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content" x-show="open === 'goresan'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200" style="max-height: 0;" x-init="$el.style.maxHeight = open === 'goresan' ? $el.scrollHeight + 'px' : '0'">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Media padat goresan (streak plate) adalah salah satu teknik dasar dalam mikrobiologi untuk memperoleh koloni tunggal dari campuran mikroorganisme. Prinsip utama dari metode ini adalah pengenceran mekanis sampel dengan cara menggoreskan inokulum secara berulang-ulang di permukaan agar padat dalam cawan Petri.</p>
                                <a href="#" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Item Akordion 2: Inokulasi Miring --}}
                    <div class="border rounded-lg overflow-hidden">
                        <button @click="open = (open === 'miring' ? '' : 'miring')" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100">
                            <span class="font-semibold text-lg">Inokulasi Miring (Slant Culture)</span>
                            <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open === 'miring' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content" x-show="open === 'miring'" x-cloak style="max-height: 0;" x-init="$el.style.maxHeight = open === 'miring' ? $el.scrollHeight + 'px' : '0'">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Teknik ini digunakan untuk menumbuhkan dan menyimpan kultur murni bakteri dalam jangka waktu yang lebih lama. Inokulum digoreskan pada permukaan media agar yang miring di dalam tabung reaksi.</p>
                                <a href="#" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Tambahkan teknik lainnya di sini dengan pola yang sama --}}

                </div>
            </div>
        </div>
    </main>
    </div>

    <script>
        // Script untuk mengatur tinggi maksimal akordion secara dinamis
        document.addEventListener('alpine:init', () => {
            Alpine.directive('resize-accordion', (el, {
                expression
            }, {
                evaluate
            }) => {
                const onOpen = () => {
                    if (evaluate(expression)) {
                        el.style.maxHeight = el.scrollHeight + 'px';
                    } else {
                        el.style.maxHeight = '0';
                    }
                };
                onOpen();
                new ResizeObserver(onOpen).observe(el);
            });
        });
    </script>
</body>

</html>