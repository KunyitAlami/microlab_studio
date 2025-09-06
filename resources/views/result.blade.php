<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Tes - MicroLab Virtual</title>
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
    @include('partials/navbar')

    <main class="max-w-2xl mx-auto px-6 pt-28 pb-10">
        <div class="bg-white text-center p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-[#1D5B79] mb-4">Hasil Belajar Anda</h1>
            <p class="text-gray-600 mb-8">Berikut adalah perbandingan hasil tes Anda sebelum dan sesudah menggunakan simulasi MicroLab Virtual.</p>

            <div class="flex justify-around items-center border-t border-b py-6">
                <div>
                    <p class="text-lg font-semibold text-gray-500">Skor Pre-Test</p>
                    <p class="text-5xl font-bold text-red-500">{{ round($preTestScore) }}%</p>
                </div>
                <div>
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-500">Skor Post-Test</p>
                    <p class="text-5xl font-bold text-green-500">{{ round($postTestScore) }}%</p>
                </div>
            </div>

            <div class="mt-8">
                @if($postTestScore > $preTestScore)
                <p class="text-xl text-gray-800">🎉 Selamat! Pemahaman Anda meningkat setelah menggunakan simulasi ini!</p>
                @else
                <p class="text-xl text-gray-800">Terima kasih telah menyelesaikan simulasi. Terus berlatih untuk meningkatkan pemahamanmu!</p>
                @endif
            </div>

            <div class="mt-10">
                <a href="{{ url('/') }}" class="inline-block px-8 py-3 bg-[#87CBB9] text-white font-semibold rounded-lg shadow-md hover:bg-[#6fa79a] transition">
                    Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </main>
</body>

</html>