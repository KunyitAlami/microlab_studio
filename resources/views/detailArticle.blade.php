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
    {{-- navbar --}}
    @include('partials/navbar')

    <main class="max-w-5xl mx-auto px-6 pt-28 pb-10">
        <!-- Header -->
        <h1 class="text-4xl font-bold text-[#1D5B79] mb-2">{{ $article['title'] }}</h1>
        <div class="flex items-center text-sm text-gray-500 mb-6">
            <span class="mr-4">✍️ {{ $article['author'] }}</span>
            <span>📅 {{ $article['date'] }}</span>
        </div>

        <!-- Gambar -->
        <div class="mb-8">
            <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}"
                class="rounded-lg shadow-lg w-full">
        </div>

        <!-- Konten -->
        <article class="prose max-w-none text-gray-700 leading-relaxed">
            {!! $article['content'] !!}
        </article>

        <!-- Tombol kembali -->
        <div class="mt-10">
            <a href="{{ route('articles.index') }}"
                class="inline-block px-6 py-3 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#6fa79a] transition">
                ← Kembali ke Daftar Artikel
            </a>
        </div>
    </main>
</body>

</html>