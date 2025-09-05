<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Article - MicroLab Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/icon.png" type="image/png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 font-[Poppins]">

    {{-- Loading Screen --}}
    <div id="loadingScreen" class="flex flex-col items-center justify-center min-h-screen text-center">
        <div class="flex justify-center items-center">
            <img src="/icon.png" class="mr-6 h-20 w-20">
            <h1 class="text-7xl font-extrabold text-[#87CBB9]">MicroLab Virtual</h1>
        </div>
        <div class="w-2/3 bg-gray-300 rounded-full h-4 overflow-hidden mt-6">
            <div id="loadingBar" class="bg-[#87CBB9] h-4 w-0 transition-all duration-200"></div>
        </div>
    </div>

    {{-- Konten --}}
    <div id="content" class="hidden opacity-0 flex transition-opacity duration-1000">
        {{-- Sidebar --}}
        @include('partials/sidebar')

        {{-- Isi Konten --}}
        <div class="flex-1 p-6 ml-64">
            <div class="flex flex-col p-4">

                {{-- Search Bar --}}
                <div class="mb-4 flex">
                    <input type="text" class="shadow w-full mr-4 p-2 pl-4 rounded-lg bg-white text-black" placeholder="Cari artikel...">
                    <a href="#" class="bg-[#87CBB9] px-3 py-2 rounded-lg ml-2">
                        <span class="text-white font-semibold">Search</span>
                    </a>
                </div>

                {{-- Artikel Section --}}
                <div class="w-full min-h-64 bg-white rounded-lg shadow p-6">
                    <h1 class="font-extrabold text-lg mb-6">Artikel Terbaru</h1>

                    {{-- Grid Artikel Dinamis --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        {{-- Loop untuk setiap artikel --}}
                        @foreach ($articles as $article)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all duration-300 flex flex-col">
                            <a href="{{ route('articles.show', ['id' => $article['id']]) }}">
                                <img class="rounded-t-lg w-full h-40 object-cover" src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" />
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <h2 class="text-md font-bold text-black">{{ $article['title'] }}</h2>
                                <p class="text-sm text-gray-600 mt-2 mb-4 flex-grow">{{ $article['excerpt'] }}</p>
                                <a href="{{ route('articles.show', ['id' => $article['id']]) }}" class="text-[#87CBB9] font-semibold hover:underline self-start">
                                    Baca selengkapnya →
                                </a>
                            </div>
                        </div>
                        @endforeach

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
            progress += 50;
            bar.style.width = progress + "%";
        }, 400);
    </script>
</body>

</html>