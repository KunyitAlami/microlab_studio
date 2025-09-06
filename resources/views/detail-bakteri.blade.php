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
        }
    </style>
</head>
<body class="bg-gray-100 font-[Poppins]">
    {{-- ambil navbar --}}
    @include('partials/navbar')
    {{-- Konten Utama --}}
    <main class="pt-24 px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 ml-6 mr-6">
            {{-- Kolom Kiri: Gambar dan Penjelasan Bakteri --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img src="{{ asset($bakteri['gambar']) }}" alt="Gambar {{ $bakteri['nama'] }}" class="w-full h-auto object-cover rounded-md">
                    <h1 class="text-3xl font-bold text-black mt-4">{{ $bakteri['nama'] }}</h1>
                    <p class="mt-4 text-black text-justify">
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

                        <div class="accordion-content" x-show="open === 'goresan'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Media padat goresan (streak plate) adalah salah satu teknik dasar dalam mikrobiologi untuk memperoleh koloni tunggal dari campuran mikroorganisme. Prinsip utama dari metode ini adalah pengenceran mekanis sampel dengan cara menggoreskan inokulum secara berulang-ulang di permukaan agar padat dalam cawan Petri.</p>
                                <div class="flex gap-12">
                                <a href="{{ route('bakteri.studio', ['id' => 1]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                                <a href="{{ route('bakteri.studio', ['id' => 1]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Pre-Test
                                </a>
                                <a href="{{ route('bakteri.studio', ['id' => 1]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Post-Test
                                </a>
                                </div>

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
                        <div class="accordion-content" x-show="open === 'miring'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Teknik ini digunakan untuk menumbuhkan dan menyimpan kultur murni bakteri dalam jangka waktu yang lebih lama. Inokulum digoreskan pada permukaan media agar yang miring di dalam tabung reaksi. Metode ini ideal untuk pemeliharaan kultur stok dan identifikasi bakteri karena memungkinkan pertumbuhan yang terkontrol dengan area permukaan yang cukup.</p>
                                <a href="{{ route('bakteri.studio', ['id' => 2]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- Item Akordion 3: Inokulasi Padat Tegak --}}
                    <div class="border rounded-lg overflow-hidden">
                        <button @click="open = (open === 'tegak' ? '' : 'tegak')" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100">
                            <span class="font-semibold text-lg">Inokulasi Padat Tegak (Deep / Stab Agar)</span>
                            <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open === 'tegak' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content" x-show="open === 'tegak'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Teknik inokulasi dengan cara menusukkan jarum inokulasi lurus ke dalam media agar padat di tabung reaksi. Metode ini digunakan untuk menguji motilitas bakteri, produksi gas, dan mengidentifikasi bakteri anaerob. Pertumbuhan akan terlihat sepanjang jalur tusukan, memberikan informasi tentang karakteristik metabolik bakteri.</p>
                                <a href="{{ route('bakteri.studio', ['id' => 3]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- Item Akordion 4: Inokulasi Cair --}}
                    <div class="border rounded-lg overflow-hidden">
                        <button @click="open = (open === 'cair' ? '' : 'cair')" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100">
                            <span class="font-semibold text-lg">Inokulasi Cair (Nutrient Broth / Broth Culture)</span>
                            <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open === 'cair' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content" x-show="open === 'cair'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Teknik menumbuhkan bakteri dalam media cair (broth) yang memungkinkan pertumbuhan bakteri secara merata dalam seluruh volume media. Metode ini digunakan untuk memperbanyak biomassa bakteri, uji biokimia, dan mempersiapkan kultur untuk berbagai keperluan penelitian. Media cair memberikan nutrisi yang homogen dan oksigenasi yang baik.</p>
                                <a href="{{ route('bakteri.studio', ['id' => 4]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- Item Akordion 5: Perataan pada Media Padat --}}
                    <div class="border rounded-lg overflow-hidden">
                        <button @click="open = (open === 'spread' ? '' : 'spread')" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100">
                            <span class="font-semibold text-lg">Perataan pada Media Padat (Spread Plate)</span>
                            <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open === 'spread' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content" x-show="open === 'spread'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Teknik ini menggunakan batang gelas steril berbentuk L untuk menyebarkan inokulum cair secara merata di seluruh permukaan agar dalam cawan Petri. Metode spread plate sangat efektif untuk menghitung jumlah bakteri (colony counting) dan memperoleh koloni yang tersebar merata dengan ukuran yang seragam untuk analisis kuantitatif.</p>
                                <a href="{{ route('bakteri.studio', ['id' => 5]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- Item Akordion 6: Pour Plate --}}
                    <div class="border rounded-lg overflow-hidden">
                        <button @click="open = (open === 'pour' ? '' : 'pour')" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100">
                            <span class="font-semibold text-lg">Teknik Pour Plate</span>
                            <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open === 'pour' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content" x-show="open === 'pour'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                            <div class="p-4 border-t text-gray-600 space-y-3 text-justify">
                                <p>Metode pour plate melibatkan pencampuran sampel bakteri dengan media agar cair yang masih hangat (±45°C) kemudian dituang ke dalam cawan Petri dan dibiarkan memadat. Teknik ini menghasilkan koloni yang tumbuh baik di permukaan maupun di dalam agar, sangat berguna untuk menghitung total bakteri termasuk yang bersifat mikroaerofil.</p>
                                <a href="{{ route('bakteri.studio', ['id' => 6]) }}" class="inline-block mt-2 px-6 py-2 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#68a08a] transition">
                                    Masuk ke Lab
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
<script> 
// Script untuk mengatur tinggi maksimal akordion secara dinamis 
document.addEventListener('alpine:init', () => { Alpine.directive('resize-accordion', (el, { expression }, { evaluate }) => { const onOpen = () => { if (evaluate(expression)) { el.style.maxHeight = el.scrollHeight + 'px'; } else { el.style.maxHeight = '0'; } }; onOpen(); new ResizeObserver(onOpen).observe(el); }); }); 

</script>
</body>
</html>