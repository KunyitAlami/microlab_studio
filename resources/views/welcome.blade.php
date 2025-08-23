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
<body class="bg-gray-100 font-[Poppins]">

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

    <!-- Konten Web -->
    <div id="content" class="hidden text-center">
        <h1 class="text-3xl font-bold mb-4">Selamat Datang 🎉</h1>
        <p class="text-gray-700">Ini isi website kamu yang muncul setelah loading selesai.</p>
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
            progress += 10;
            bar.style.width = progress + "%";
        }, 400);
    </script>
</body>
</html>
