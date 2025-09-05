<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $article['title'] }} - MicroLab Virtual</title>
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
    {{-- Navbar --}}
    @include('partials/navbar')

    <main class="max-w-7xl mx-auto px-6 pt-28 pb-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Konten Artikel Utama --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-4xl font-bold text-[#1D5B79] mb-2">{{ $article['title'] }}</h1>
                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <span class="mr-4">✍️ {{ $article['author'] }}</span>
                    <span>📅 {{ $article['date'] }}</span>
                </div>

                <div class="mb-8">
                    <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}"
                        class="rounded-lg shadow-lg w-full">
                </div>

                <article class="prose max-w-none text-gray-700 leading-relaxed text-justify">
                    {!! $article['content'] !!}
                </article>

                <div class="mt-10">
                    <a href="{{ route('articles.index') }}"
                        class="inline-block px-6 py-3 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#6fa79a] transition">
                        ← Kembali ke Daftar Artikel
                    </a>
                </div>
            </div>

            {{-- Kolom Kanan: Sidebar Artikel Lain --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-md sticky top-28">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Baca Juga</h3>
                    <div class="space-y-4">
                        @foreach ($otherArticles as $other)
                        <a href="{{ route('articles.show', ['id' => $other['id']]) }}" class="block group">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset($other['image']) }}" alt="{{ $other['title'] }}" class="w-20 h-20 object-cover rounded-md flex-shrink-0">
                                <div>
                                    <h4 class="font-semibold text-gray-700 group-hover:text-[#1D5B79] transition">{{ $other['title'] }}</h4>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>

</html>