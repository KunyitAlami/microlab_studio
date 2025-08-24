{{-- resources/views/studio.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Studio Lab - MicroLab Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-800 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-white">Selamat Datang di Lab Virtual!</h1>
        <p class="text-xl text-gray-300 mt-4">Simulasi untuk teknik <span class="font-semibold text-yellow-400">{{ $teknik }}</span> akan muncul di sini.</p>
        <a href="{{ route('bakteri.show', $id_bakteri) }}" class="mt-8 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
            Kembali ke Detail Bakteri
        </a>
    </div>
</body>
</html>