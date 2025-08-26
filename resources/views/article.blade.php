<!DOCTYPE html>
<html lang="en">
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
    @include('partials/navbar')
    <main class="p-6">
        <h1 class="text-3xl font-bold mb-4">Artikel</h1>
        <p class="text-gray-700">Selamat datang di artikel MicroLab Virtual. Di sini Anda akan menemukan berbagai informasi dan panduan mengenai mikrobiologi.</p>
    </main>
</body>
</html>