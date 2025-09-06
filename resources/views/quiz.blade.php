<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $quiz['title'] }} - MicroLab Virtual</title>
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

    <main class="max-w-4xl mx-auto px-6 pt-28 pb-10">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-[#1D5B79] mb-2">{{ $quiz['title'] }}</h1>
            <p class="text-gray-600 mb-8">
                @if($type === 'pre-test')
                Jawab pertanyaan berikut untuk mengukur pemahaman awal Anda sebelum memulai simulasi.
                @else
                Jawab kembali pertanyaan berikut untuk melihat peningkatan pemahaman Anda setelah simulasi.
                @endif
            </p>

            <form action="{{ route('bakteri.submitQuiz', ['id' => $bakteri_id, 'type' => $type]) }}" method="POST">
                @csrf
                <div class="space-y-6">
                    @foreach($quiz['questions'] as $id => $q)
                    <div class="border-t pt-4">
                        <p class="font-semibold text-lg text-gray-800">{{ $loop->iteration }}. {{ $q['question'] }}</p>
                        <div class="mt-3 space-y-2">
                            @foreach($q['options'] as $key => $option)
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="answers[{{ $id }}]" value="{{ $key }}" class="h-5 w-5 text-[#87CBB9] focus:ring-[#6fa79a]">
                                <span class="ml-4 text-gray-700">{{ $option }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8 text-right">
                    <button type="submit" class="px-8 py-3 bg-[#87CBB9] text-white font-bold rounded-lg shadow-md hover:bg-[#6fa79a] transition">
                        Selesai & Lanjutkan
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>