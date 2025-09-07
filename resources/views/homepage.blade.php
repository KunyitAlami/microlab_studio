<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>MicroLab Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/icon.png" type="image/png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>

<body class="bg-gray-100 font-[Poppins] ">

    {{-- bagian 1 --}}
    {{-- loading screen --}}
    <div id="loadingScreen" class="flex flex-col items-center justify-center min-h-screen text-center">
        {{-- logo dan judul microlab --}}
        <div class="flex justify-center items-center">
            <img src="icon.png" class="mr-6 h-20 w-20">
            <h1 class="text-7xl font-extrabold text-[#87CBB9]">MicroLab Virtual</h1>
        </div>

        {{-- loading bar and text --}}
        <div class="w-2/3 bg-gray-300 rounded-full h-4 overflow-hidden mt-6">
            <div id="loadingBar" class="bg-[#87CBB9] h-4 w-0 transition-all duration-200"></div>
        </div>
    </div>

    {{-- bagian 2 --}}
    <!-- Konten Web -->
    <div id="content" class="hidden opacity-0 flex transition-opacity duration-1000">
        {{-- ambil sidebar --}}
        @include('partials/sidebar')

        {{-- bagian isi --}}
        <div class="flex-1 p-6 ml-64">
            {{-- bagian inti--}}
            <div class="flex flex-col p-4">
                {{-- bagian searching --}}
                <div class="mb-4 flex">
                    <input type="text" class="shadow w-full mr-4 p-2 pl-4 rounded-lg bg-white text-black" placeholder="Search Bacteria...">
                    <a href="#" class="bg-[#87CBB9] px-3 py-2 rounded-lg ml-2"><span class="text-white font-semibold">Submit</span></a>
                </div>

                {{-- bagian menu bakteri --}}
                <div class="w-full min-h-64 bg-white rounded-lg shadow p-4">
                    {{-- bagian judul dan bagian card bakteri --}}
                    <div class="mt-2 ml-4 flex flex-col">
                        {{-- judul --}}
                        <div>
                            <h1 class="font-extrabold text-lg">Bacteria</h1>
                        </div>
                        {{-- bagian bakteri --}}
                        {{-- bagian pertama --}}
                        <div class="mt-10 flex justify-evenly">
                            {{-- bakteri pertama --}}
                            <div class="relative group w-74 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
                                <a>
                                    <img class="rounded-t-lg w-full h-40 object-cover transition-all duration-300 group-hover:brightness-75" src="assets/bakteri/1.jpeg" alt="" />
                                </a>
                                <div class="m-2 text-justify">
                                    <p class="text-md font-bold text-black">Escherichia coli (E. coli)</p>
                                    <p class="text-sm mt-1 mb-3 text-black">
                                        Bakteri yang umum ditemukan di usus manusia. Sebagian besar tidak berbahaya, tetapi ada strain tertentu yang dapat menyebabkan diare.
                                    </p>
                                </div>

                                <!-- Overlay button -->
                                <a href="{{ route('bakteri.show', ['id' => 1]) }}">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="font-semibold px-4 py-2 bg-[#87CBB9] text-white rounded-lg shadow-md hover:bg-blue-800 transition">
                                            Go to Lab Virtual
                                        </button>
                                    </div>
                                </a>
                            </div>

                            {{-- bakteri kedua --}}
                            <div class="relative group w-74 bg-white border border-gray-200 rounded-lg ml-7 mr-7 shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
                                <a>
                                    <img class="rounded-t-lg w-full h-40 object-cover transition-all duration-300 group-hover:brightness-75" src="assets/bakteri/2.jpeg" alt="" />
                                </a>
                                <div class="m-2 text-justify">
                                    <p class="text-md font-bold text-black">Salmonella sp.</p>
                                    <p class="text-sm mt-1 mb-3 text-black">
                                        Bakteri penyebab keracunan makanan yang biasanya berasal dari makanan mentah atau kurang matang, seperti telur dan ayam.
                                    </p>
                                </div>

                                <!-- Overlay button -->
                                <a href="{{ route('bakteri.show', ['id' => 2]) }}">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class=" font-semibold px-4 py-2 bg-[#87CBB9] text-white rounded-lg shadow-md hover:bg-blue-800 transition">
                                            Go to Lab Virtual
                                        </button>
                                    </div>
                                </a>
                            </div>

                            {{-- bakteri ketiga --}}
                            <div class="relative group w-74 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
                                <a>
                                    <img class="rounded-t-lg w-full h-40 object-cover transition-all duration-300 group-hover:brightness-75" src="assets/bakteri/3.jpeg" alt="" />
                                </a>
                                <div class="m-2 text-justify">
                                    <p class="text-md font-bold text-black">Staphylococcus aureus</p>
                                    <p class="text-sm mt-1 mb-3 text-black">
                                        Bakteri yang sering hidup di kulit manusia. Dapat menyebabkan infeksi kulit ringan hingga keracunan makanan.
                                    </p>
                                </div>

                                <!-- Overlay button -->
                                <a href="{{ route('bakteri.show', ['id' => 3]) }}">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="font-semibold px-4 py-2 bg-[#87CBB9] text-white rounded-lg shadow-md hover:bg-blue-800 transition">
                                            Go to Lab Virtual
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {{-- bagian kedua --}}
                        <div class="mt-10 flex justify-evenly">
                            {{-- bakteri keeempat --}}
                            <div class="relative group w-74 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
                                <a>
                                    <img class="rounded-t-lg w-full h-40 object-cover transition-all duration-300 group-hover:brightness-75" src="assets/bakteri/4.jpeg" alt="" />
                                </a>
                                <div class="m-2 text-justify">
                                    <p class="text-md font-bold text-black">Bacillus subtilis</p>
                                    <p class="text-sm mt-1 mb-3 text-black">
                                        Bakteri yang hidup di tanah dan sering digunakan dalam penelitian karena mudah tumbuh dan relatif aman.
                                    </p>
                                </div>

                                <!-- Overlay button -->
                                <a href="{{ route('bakteri.show', ['id' => 4]) }}">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="font-semibold px-4 py-2 bg-[#87CBB9] text-white rounded-lg shadow-md hover:bg-blue-800 transition">
                                            Go to Lab Virtual
                                        </button>
                                    </div>
                                </a>
                            </div>

                            {{-- bakteri kelima --}}
                            <div class="relative group w-74 bg-white border border-gray-200 rounded-lg ml-7 mr-7 shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
                                <a>
                                    <img class="rounded-t-lg w-full h-40 object-cover transition-all duration-300 group-hover:brightness-75" src="assets/bakteri/5.jpeg" alt="" />
                                </a>
                                <div class="m-2 text-justify">
                                    <p class="text-md font-bold text-black">Clostridium botulinum</p>
                                    <p class="text-sm mt-1 mb-3 text-black">
                                        Bakteri yang menghasilkan toksin botulinum, salah satu racun paling mematikan, tetapi juga digunakan dalam produk medis (Botox).
                                    </p>
                                </div>

                                <!-- Overlay button -->
                                <a href="{{ route('bakteri.show', ['id' => 5]) }}">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="font-semibold px-4 py-2 bg-[#87CBB9] text-white rounded-lg shadow-md hover:bg-blue-800 transition">
                                            Go to Lab Virtual
                                        </button>
                                    </div>
                                </a>
                            </div>

                            {{-- bakteri keenam --}}
                            <div class="relative group w-74 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
                                <a>
                                    <img class="rounded-t-lg w-full h-40 object-cover transition-all duration-300 group-hover:brightness-75" src="assets/bakteri/6.jpeg" alt="" />
                                </a>
                                <div class="m-2 text-justify">
                                    <p class="text-md font-bold text-black">Mycobacterium tuberculosis</p>
                                    <p class="text-sm mt-1 mb-3 text-black">
                                        Bakteri penyebab penyakit tuberkulosis (TBC) yang menyerang paru-paru dan masih menjadi masalah kesehatan global.
                                    </p>
                                </div>

                                <!-- Overlay button -->
                                <a href="{{ route('bakteri.show', ['id' => 6]) }}">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="font-semibold px-4 py-2 bg-[#87CBB9] text-white rounded-lg shadow-md hover:bg-blue-800 transition">
                                            Go to Lab Virtual
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>




    <script>
        const bar = document.getElementById("loadingBar");
        const loadingScreen = document.getElementById("loadingScreen");
        const content = document.getElementById("content");

        let progress = 0;
        let interval = setInterval(() => {
            if (progress >= 100) {
                clearInterval(interval);

                loadingScreen.classList.add("opacity-0");
                setTimeout(() => {
                    loadingScreen.classList.add("hidden");

                    content.classList.remove("hidden");
                    setTimeout(() => {
                        content.classList.add("opacity-100");
                    }, 50);
                }, 700);
                return;
            }
            progress += 8;
            bar.style.width = progress + "%";
        }, 400);
    </script>
</body>

</html>