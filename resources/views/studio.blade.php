<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Studio Lab - MicroLab Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#87CBB9] font-[Poppins] flex flex-col">

    <canvas id="labCanvas" height="800" width="1920" class=""></canvas>
    {{-- button navigasi --}}
    <div id="navigationButtons" class="flex justify-center gap-6 mt-7" style="display: none;">
        <a href="#" onclick="window.location.reload();" class="px-4 py-2 bg-white text-gray-600 rounded-xl
            hover:border-2 hover:border-black hover:bg-gray-200 hover:text-black
            transition-all duration-300 ease-in-out font-bold">
            Ulangi Simulasi
        </a>
        <a href="{{ route('bakteri.quiz', ['id' => $id_bakteri, 'type' => 'post-test']) }}" class="px-6 py-3 bg-white text-green-600 rounded-xl
            hover:border-2 hover:border-black hover:bg-gray-200 hover:text-black
            transition-all duration-300 ease-in-out font-bold text-lg">
            Selesai & Lanjut ke Post-Test →
        </a>
    </div>


</body>

</html>
<script>
    const canvas = document.getElementById("labCanvas");
    const ctx = canvas.getContext("2d");
    ctx.font = "bold 24px 'Poppins', sans-serif";

    // jenis jenis ose
    const imgOseTampilan = new Image();
    imgOseTampilan.src = "/assets/alat/ose_bulat_tampilan.png";

    const imgOse = new Image();
    imgOse.src = "/assets/alat/ose_bulat_besar.png";

    const imgOseSteril = new Image();
    imgOseSteril.src = "/assets/alat/ose_steril.png";

    const imgOseBakteri = new Image();
    imgOseBakteri.src = "/assets/alat/ose_bakteri.png";

    const imgSpiritus = new Image();
    imgSpiritus.src = "/assets/alat/spiritus_nyala.png";

    const imgSpiritusMati = new Image();
    imgSpiritusMati.src = "/assets/alat/spiritus_mati.png";

    const imgCawan = new Image();
    imgCawan.src = "/assets/alat/cawan_petri.png";

    const imgTabung = new Image();
    imgTabung.src = "/assets/alat/tabung_bakteri.png";

    const imgTabungTampilan = new Image();
    imgTabungTampilan.src = "/assets/alat/tabung_tampilan.png";

    const imgTabungHomogen = new Image();
    imgTabungHomogen.src = "/assets/alat/tabung_homogen.png";

    const imgInkubator = new Image();
    imgInkubator.src = "/assets/alat/inkubator.png";

    const imgRakTabung = new Image();
    imgRakTabung.src = "/assets/alat/rak_tabung.png";

    const imgGores = new Image();
    imgGores.src = "/assets/alat/gores.png";

    const imgHasil = new Image();
    imgHasil.src = "/assets/alat/hasil_inokulasi_gesek.png";

    const sfxKocok = new Audio("/sfx/kocok.mp3");
    sfxKocok.volume = 0.6; // atur volume biar ga berisik
    sfxKocok.loop = false;

    const sfxApi = new Audio("/sfx/api.wav");
    sfxApi.volume = 0.6; // atur volume biar ga berisik
    sfxApi.loop = true;

    const sfx24Detik = new Audio("/sfx/24detik.mp3");
    sfx24Detik.volume = 0.6; // atur volume biar ga berisik
    sfx24Detik.loop = true;

    const sfxbgm = new Audio("/sfx/bgm.mp3");
    sfxbgm.volume = 0.3; // atur volume biar ga berisik
    sfxbgm.loop = true;


    let currentScene = 0;

    function wrapText(ctx, text, x, y, maxWidth, lineHeight, align = "left") {
        const words = text.split(" ");
        let line = "";
        ctx.textAlign = align;

        for (let n = 0; n < words.length; n++) {
            let testLine = line + words[n] + " ";
            let metrics = ctx.measureText(testLine);
            let testWidth = metrics.width;

            if (testWidth > maxWidth && n > 0) {
                ctx.fillText(line, align === "center" ? x + maxWidth / 2 : x, y);
                line = words[n] + " ";
                y += lineHeight;
            } else {
                line = testLine;
            }
        }
        ctx.fillText(line, align === "center" ? x + maxWidth / 2 : x, y);
        return y;
    }

    let isDragging = false;
    let startX = 0;
    let tabungX = 0;
    let tabungY = 0;
    let tabungWidth = 500;
    let tabungHeight = 200;
    let gerakanHomogenisasi = 0;
    let lastMoveDirection = 0; // 1 = kanan, -1 = kiri
    let isCompleted = false;


    const langkah = [{
            judul: "Homogenisasi suspensi bakteri",
            isi: "Suspensi bakteri diputar atau dikocok ringan agar sel bakteri tercampur merata..."
        },
        {
            judul: "Sterilisasi ose bulat (loop)",
            isi: "Ose logam dipanaskan di atas api hingga pijar merah agar bebas dari mikroba..."
        },
        {
            judul: "Mengambil sampel bakteri",
            isi: "Ose yang sudah dingin dicelupkan ke dalam suspensi bakteri dengan hati-hati..."
        },
        {
            judul: "Goresan pada nutrient agar",
            isi: "Ose digoreskan pada bagian agar dengan pola zig-zag untuk menyebarkan bakteri..."
        },
        {
            judul: "Sterilisasi ulang ose",
            isi: "Setelah goresan pertama, ose kembali dipijarkan di api bunsen lalu didinginkan..."
        },
        {
            judul: "Inkubasi dan hasil isolasi",
            isi: "Cawan petri ditutup, dibalik, lalu diinkubasi pada suhu sesuai jenis bakteri..."
        }
    ];
    const scenes = [
        function sceneIntro() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "#ededed";
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = "black";
            ctx.font = "bold 56px Poppins";
            let text1 = "Selamat Datang di Labotarium MicroLab Virtual";
            ctx.fillText(text1, canvas.width / 2, 360);

            ctx.font = "20px Poppins";
            let text3 = "Klik di mana saja untuk melanjutkan...";
            ctx.fillText(text3, canvas.width / 2, 760);
        },

        function scene1() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "#ededed";
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = "black";
            ctx.font = "bold 32px Poppins";
            const title = "Alat-Alat yang Akan Kita Gunakan Pada Teknik Inokulasi Goresan/Gesekan:";
            ctx.fillText(title, 950, 50);
            if (sfxbgm.paused) {
                sfxbgm.currentTime = 0;
                sfxbgm.play().catch(err => console.warn("⚠️ Autoplay blocked:", err));
                console.log("🎵 BGM started");
            }

            const alat = [{
                    nama: "Ose Bulat",
                    fungsi: "Untuk mengambil dan menggores bakteri pada media.",
                    gambar: imgOseTampilan
                },
                {
                    nama: "Spiritus",
                    fungsi: "Sebagai sumber api untuk sterilisasi ose bulat.",
                    gambar: imgSpiritus
                },
                {
                    nama: "Cawan Petri (NA Plate)",
                    fungsi: "Berisi media nutrient agar tempat tumbuh bakteri.",
                    gambar: imgCawan
                },
                {
                    nama: "Tabung Bakteri",
                    fungsi: "Berisi suspensi bakteri yang akan diinokulasi.",
                    gambar: imgTabungTampilan
                },
                {
                    nama: "Inkubator",
                    fungsi: "Tempat inkubasi agar bakteri tumbuh optimal.",
                    gambar: imgInkubator
                },
                {
                    nama: "Rak Tabung",
                    fungsi: "Tempat untuk meletakan tabung bakteri sebelum dan sesudah digunakan",
                    gambar: imgRakTabung
                },
            ];

            let cardWidth = 500;
            let cardHeight = 180;
            let gapX = 40;
            let gapY = 40;
            let padding = 20;

            const maxCols = 2;
            const startX = (canvas.width - (maxCols * cardWidth + (maxCols - 1) * gapX)) / 2;
            const startY = 100;

            alat.forEach((item, index) => {
                let col = index % maxCols;
                let row = Math.floor(index / maxCols);
                let x = startX + col * (cardWidth + gapX);
                let y = startY + row * (cardHeight + gapY);

                ctx.fillStyle = "white";
                ctx.strokeStyle = "#333";
                ctx.lineWidth = 2;
                ctx.fillRect(x, y, cardWidth, cardHeight);
                ctx.strokeRect(x, y, cardWidth, cardHeight);

                // Gambar
                let imgWidth = 100;
                let imgHeight = 80;
                const imgX = x + (cardWidth - imgWidth) / 2;
                const imgY = y + padding;
                ctx.drawImage(item.gambar, imgX, imgY, imgWidth, imgHeight);

                // Nama alat
                ctx.fillStyle = "black";
                ctx.font = "bold 16px Poppins";
                ctx.textAlign = "center";
                ctx.fillText(item.nama, x + cardWidth / 2, y + padding + imgHeight + 20);

                // Deskripsi
                let descX = x + padding; // tetap start kiri kartu
                let textWidth = cardWidth - 2 * padding;
                ctx.font = "14px Poppins";
                let descY = y + padding + imgHeight + 40;
                wrapText(ctx, item.fungsi, descX, descY, textWidth, 18, "center");
            });
            ctx.font = "20px Poppins";
            let text3 = "Klik di mana saja untuk memulai langkah pertama...";
            ctx.fillText(text3, canvas.width / 2, 760);
        },

        // langkah pertama
        // Fixed scene3 function - corrected the currentScene increment
        function scene3() {
            // CLEANUP semua event listener sebelumnya
            cleanupAllEventListeners();

            // Menampilkan overlay transisi
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "rgba(0, 0, 0, 0.8)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "white";
            ctx.font = "bold 28px Poppins";
            ctx.textAlign = "center";
            ctx.fillText("Tahap 1: Inokulasi Goresan", canvas.width / 2, canvas.height / 2 - 20);
            ctx.font = "20px Poppins";
            ctx.fillText("Kita akan masuk ke tahap pertama dari teknik goresan/gesekan", canvas.width / 2, canvas.height / 2 + 20);
            ctx.font = "20px Poppins";
            ctx.fillText("Homogenisasi Bakteri", canvas.width / 2, canvas.height / 2 + 50);

            setTimeout(() => {
                const scaleFactor = 0.25;
                let lastPlayTime = 0;

                function playKocokSFX() {
                    const now = Date.now();
                    if (now - lastPlayTime > 300) {
                        // kasih jeda 300ms biar ga overlap
                        sfxKocok.currentTime = 0;
                        sfxKocok.play();
                        lastPlayTime = now;
                    }
                }


                let tabungWidth, tabungHeight;
                if (imgTabung && imgTabung.complete && imgTabung.naturalWidth) {
                    tabungWidth = imgTabung.naturalWidth * scaleFactor;
                    tabungHeight = imgTabung.naturalHeight * scaleFactor;
                } else {
                    // Fallback yang sama dengan asli 
                    tabungWidth = 120;
                    tabungHeight = 300;
                }

                const drawWidth = tabungWidth * 0.42;
                const drawHeight = tabungHeight * 0.5;
                let totalDistanceMoved = 0;
                const threshold = 1000;
                let isCompleted = false;
                let isDragging = false;
                let startX = 0;
                let tabungX = (canvas.width / 2) - 250;
                let tabungY = (canvas.height / 2) - 150;
                let sceneActive = true;

                function drawScene() {
                    if (!sceneActive) return;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "#ededed";
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "black";
                    ctx.font = "bold 24px Poppins";
                    ctx.textAlign = "start";
                    ctx.fillText("Langkah 1: Homogenisasi suspensi bakteri", 20, 40);
                    ctx.font = "20px Poppins";
                    let instruksi = "Instruksi: Geser tabung bakteri ke kanan dan ke kiri untuk menghomogenisasi...";
                    ctx.fillText(instruksi, 20, 70);
                    ctx.font = "18px Poppins";
                    let progress = Math.min(100, Math.floor((totalDistanceMoved / threshold) * 100));
                    let gerakanText = "Progress: " + progress + "%";
                    ctx.fillText(gerakanText, 20, 100);

                    // Gambar tabung
                    if (isCompleted) {
                        ctx.drawImage(imgTabungHomogen, (tabungX + 192), (tabungY - 100), drawWidth, drawHeight);
                    } else {
                        ctx.drawImage(imgTabung, (tabungX + 190), (tabungY - 100), drawWidth, drawHeight);
                    }

                    // Tombol lanjutkan
                    if (isCompleted) {
                        const buttonX = canvas.width / 2 - 100;
                        const buttonY = canvas.height - 100;
                        const buttonWidth = 200;
                        const buttonHeight = 50;
                        ctx.fillStyle = "#87CBB9";
                        ctx.fillRect(buttonX, buttonY, buttonWidth, buttonHeight);


                        ctx.fillStyle = "white";
                        ctx.font = "bold 20px Poppins";
                        ctx.textAlign = "center";
                        ctx.textBaseline = "middle";
                        ctx.fillText("Lanjutkan", buttonX + buttonWidth / 2, buttonY + buttonHeight / 2);
                    }
                }

                function onMouseDown(e) {
                    if (!sceneActive) return;
                    e.preventDefault();
                    e.stopPropagation();
                    const rect = canvas.getBoundingClientRect();
                    const mouseX = e.clientX - rect.left;
                    const mouseY = e.clientY - rect.top;

                    if (mouseX >= tabungX && mouseX <= tabungX + drawWidth &&
                        mouseY >= tabungY && mouseY <= tabungY + drawHeight) {
                        isDragging = true;
                        startX = mouseX - tabungX;
                        canvas.style.cursor = 'grabbing';
                    }
                }

                function getMousePos(e) {
                    const rect = canvas.getBoundingClientRect();
                    const scaleX = canvas.width / rect.width;
                    const scaleY = canvas.height / rect.height;
                    return {
                        x: (e.clientX - rect.left) * scaleX,
                        y: (e.clientY - rect.top) * scaleY
                    };
                }


                function onMouseMove(e) {
                    if (!isDragging || !sceneActive) return;
                    e.preventDefault();

                    const rect = canvas.getBoundingClientRect();
                    const newTabungX = e.clientX - rect.left - startX;

                    totalDistanceMoved += Math.abs(newTabungX - tabungX);

                    tabungX = newTabungX;
                    tabungX = Math.min(Math.max(tabungX, 50), canvas.width - tabungWidth - 50);

                    drawScene();

                    if (totalDistanceMoved >= threshold && !isCompleted) {
                        isCompleted = true;
                        drawScene();
                        canvas.style.cursor = 'default';
                    }

                    playKocokSFX();
                }


                function onMouseUp(e) {
                    if (!sceneActive) return;
                    e.preventDefault();
                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    if (isCompleted) {
                        const buttonX = canvas.width / 2 - 100;
                        const buttonY = canvas.height - 100;
                        const buttonWidth = 200;
                        const buttonHeight = 50;

                        if (mouseX >= buttonX && mouseX <= buttonX + buttonWidth &&
                            mouseY >= buttonY && mouseY <= buttonY + buttonHeight) {
                            sceneActive = false;
                            cleanupScene3();
                            currentScene = 3;
                            scenes[currentScene]();
                            return;
                        }
                    }

                    isDragging = false;
                    canvas.style.cursor = 'default';
                }

                function cleanupScene3() {
                    canvas.removeEventListener('mousedown', onMouseDown);
                    canvas.removeEventListener('mousemove', onMouseMove);
                    canvas.removeEventListener('mouseup', onMouseUp);
                    canvas.removeEventListener('mouseout', onMouseUp);
                }

                // Simpan reference dan tambah listener
                canvas.scene3MouseDown = onMouseDown;
                canvas.scene3MouseMove = onMouseMove;
                canvas.scene3MouseUp = onMouseUp;

                canvas.addEventListener('mousedown', onMouseDown);
                canvas.addEventListener('mousemove', onMouseMove);
                canvas.addEventListener('mouseup', onMouseUp);
                canvas.addEventListener('mouseout', onMouseUp);

                drawScene();
            }, 1500);
        },

        function scene4() {
            cleanupAllEventListeners();

            let spiritusOn = false;
            let oseVisible = false;
            let isDragging = false;
            let isSteril = false;
            let sceneActive = true;
            const button = {
                x: 20,
                y: 120,
                width: 120,
                height: 40
            };
            let ose = {
                x: canvas.width / 2 - 50,
                y: canvas.height / 2 - 100,
                width: 400,
                height: 50
            };
            let sterilProgress = 0;
            let sterilInterval = null;
            const sterilDuration = 3000;

            // Tampilkan intro
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "rgba(0, 0, 0, 0.8)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "white";
            ctx.font = "bold 28px Poppins";
            ctx.textAlign = "center";
            ctx.fillText("Tahap 2: Inokulasi Goresan", canvas.width / 2, canvas.height / 2 - 20);
            ctx.font = "20px Poppins";
            ctx.fillText("Kita akan masuk ke tahap kedua dari teknik goresan/gesekan", canvas.width / 2, canvas.height / 2 + 20);
            ctx.fillText("Panaskan Ose Bulat", canvas.width / 2, canvas.height / 2 + 50);

            setTimeout(() => {
                function drawScene() {
                    if (!sceneActive) return;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "#ededed";
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "black";
                    ctx.font = "bold 24px Poppins";
                    ctx.textAlign = "start";
                    ctx.fillText("Langkah 2: Sterilkan Ose Bulat di atas Spiritus", 20, 40);
                    ctx.font = "20px Poppins";
                    ctx.fillText("Instruksi: Nyalakan Spiritus dan Letakan Ose Bulat di atasnya", 20, 80);

                    // status ose
                    ctx.font = "17px Poppins";
                    ctx.fillStyle = "black";
                    if (isSteril) {
                        ctx.fillText("Ose Bulat: Steril ✅", 20, 110);
                    } else {
                        ctx.fillText("Ose Bulat: Belum Steril (" + Math.floor(sterilProgress) + "%)", 20, 110);
                    }

                    // progress bar
                    ctx.strokeStyle = "black";
                    ctx.strokeRect(20, 130, 200, 20);
                    ctx.fillStyle = isSteril ? "green" : "orange";
                    ctx.fillRect(20, 130, 2 * sterilProgress, 20);

                    // spiritus
                    if (spiritusOn) {
                        ctx.drawImage(imgSpiritus, (canvas.width / 2) - 150, (canvas.height / 2) + 102, 300, 300);
                    } else {
                        ctx.drawImage(imgSpiritusMati, (canvas.width / 2) - 150, (canvas.height / 2) + 102, 300, 300);
                    }

                    // ose
                    if (oseVisible) {
                        ctx.drawImage(imgOse, ose.x, ose.y, ose.width, ose.height);
                    }

                    // tombol spiritus
                    ctx.fillStyle = spiritusOn ? "green" : "red";
                    ctx.fillRect(button.x, button.y + 45, button.width, button.height);
                    ctx.fillStyle = "white";
                    ctx.font = "16px Poppins";
                    ctx.textAlign = "center";
                    ctx.fillText(spiritusOn ? "Matikan" : "Nyalakan", button.x + button.width / 2, button.y + 65);

                    // tombol lanjut
                    if (isSteril) {
                        const btnX = canvas.width / 2 - 100;
                        const btnY = canvas.height - 100;
                        const btnW = 200;
                        const btnH = 50;
                        ctx.fillStyle = "#87CBB9";
                        ctx.fillRect(btnX, btnY, btnW, btnH);
                        ctx.fillStyle = "white";
                        ctx.font = "bold 20px Poppins";
                        ctx.textAlign = "center";
                        ctx.textBaseline = "middle";
                        ctx.fillText("Lanjutkan", btnX + btnW / 2, btnY + btnH / 2);
                    }
                }

                function resetSterilProgress() {
                    sterilProgress = 0;
                    if (sterilInterval) {
                        clearInterval(sterilInterval);
                        sterilInterval = null;
                    }
                }

                function startSterilProgress() {
                    if (!sterilInterval && !isSteril && sceneActive) {
                        sterilInterval = setInterval(() => {
                            if (!sceneActive) {
                                clearInterval(sterilInterval);
                                return;
                            }
                            sterilProgress += 100 / (sterilDuration / 100);
                            if (sterilProgress >= 100) {
                                sterilProgress = 100;
                                isSteril = true;
                                clearInterval(sterilInterval);
                                sterilInterval = null;
                            }
                            drawScene();
                        }, 100);
                    }
                }

                function getMousePos(e) {
                    const rect = canvas.getBoundingClientRect();
                    const scaleX = canvas.width / rect.width; // rasio lebar
                    const scaleY = canvas.height / rect.height; // rasio tinggi
                    return {
                        x: (e.clientX - rect.left) * scaleX,
                        y: (e.clientY - rect.top) * scaleY
                    };
                }

                function clickHandler(e) {
                    if (!sceneActive) return;
                    e.preventDefault();
                    e.stopPropagation();

                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    const spiritusBtn = {
                        x: button.x,
                        y: button.y + 45,
                        width: button.width,
                        height: button.height
                    };

                    // tombol spiritus
                    if (mouseX >= spiritusBtn.x && mouseX <= spiritusBtn.x + spiritusBtn.width &&
                        mouseY >= spiritusBtn.y && mouseY <= spiritusBtn.y + spiritusBtn.height) {

                        if (!spiritusOn) {
                            oseVisible = true;
                            spiritusOn = true;

                            sfxApi.currentTime = 0;
                            sfxApi.play();
                        } else {
                            spiritusOn = false;

                            sfxApi.pause();
                            sfxApi.currentTime = 0;
                        }

                        drawScene();
                    }

                    // tombol lanjut
                    if (isSteril) {
                        const btnX = canvas.width / 2 - 100;
                        const btnY = (canvas.height) - 100;
                        const btnW = 200;
                        const btnH = 50;
                        if (mouseX >= btnX && mouseX <= btnX + btnW &&
                            mouseY >= (btnY) && mouseY <= (btnY) + btnH) {
                            sceneActive = false;
                            cleanupScene4();
                            currentScene = 4;
                            scenes[currentScene]();
                            return;
                        }
                    }
                }



                // Rest of the handlers remain the same...
                function mouseDownHandler(e) {
                    if (!oseVisible || !sceneActive) return;
                    e.preventDefault();
                    e.stopPropagation();

                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    if (mouseX >= ose.x + (2 * ose.width / 3) && mouseX <= ose.x + ose.width &&
                        mouseY >= ose.y && mouseY <= ose.y + ose.height) {
                        isDragging = true;
                        offsetX = mouseX - ose.x;
                        offsetY = mouseY - ose.y;
                    }
                }

                function mouseMoveHandler(e) {
                    if (!isDragging || !sceneActive) return;
                    e.preventDefault();

                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    ose.x = mouseX - offsetX;
                    ose.y = mouseY - offsetY;

                    if (spiritusOn) {
                        let flame = {
                            x: (canvas.width / 2) - 50,
                            y: (canvas.height / 2) + 80,
                            width: 100,
                            height: 120
                        };
                        if (ose.x < flame.x + flame.width && ose.x + ose.width > flame.x &&
                            ose.y < flame.y + flame.height && ose.y + ose.height > flame.y) {
                            startSterilProgress();
                        } else {
                            resetSterilProgress();
                        }
                    } else {
                        resetSterilProgress();
                    }
                    drawScene();
                }


                function mouseUpHandler() {
                    if (!sceneActive) return;
                    isDragging = false;
                }

                function cleanupScene4() {
                    if (sterilInterval) {
                        clearInterval(sterilInterval);
                        sterilInterval = null;
                    }
                    sfxApi.pause();
                    sfxApi.currentTime = 0;
                    canvas.removeEventListener("click", clickHandler);
                    canvas.removeEventListener("mousedown", mouseDownHandler);
                    canvas.removeEventListener("mousemove", mouseMoveHandler);
                    canvas.removeEventListener("mouseup", mouseUpHandler);
                    canvas.removeEventListener("mouseleave", mouseUpHandler);
                }

                // Simpan reference dan tambah listener
                canvas.scene4Click = clickHandler;
                canvas.scene4MouseDown = mouseDownHandler;
                canvas.scene4MouseMove = mouseMoveHandler;
                canvas.scene4MouseUp = mouseUpHandler;

                canvas.addEventListener("click", clickHandler);
                canvas.addEventListener("mousedown", mouseDownHandler);
                canvas.addEventListener("mousemove", mouseMoveHandler);
                canvas.addEventListener("mouseup", mouseUpHandler);
                canvas.addEventListener("mouseleave", mouseUpHandler);

                let offsetX = 0;
                let offsetY = 0;
                drawScene();
            }, 1500);
        },

        function scene5() {
            cleanupAllEventListeners();

            let spiritusOn = false;
            let oseVisible = true;
            let isDragging = false;
            let currentStage = 1;
            let tabungAngle = 0;
            let oseHasBakteri = false;
            let showAmbilButton = false;
            let showNextButton = false;
            let sceneActive = true;

            const button = {
                x: 20,
                y: 120,
                width: 120,
                height: 40
            };
            const ambilButton = {
                x: canvas.width / 2 - 100,
                y: canvas.height - 100,
                width: 200,
                height: 40
            };
            const nextButton = {
                x: canvas.width - 150,
                y: canvas.height - 60,
                width: 120,
                height: 40
            };

            let ose = {
                x: canvas.width / 2 - 50,
                y: canvas.height / 2 - 100,
                width: 400,
                height: 50
            };

            const tabungArea = {
                x: (canvas.width / 2) - 200,
                y: (canvas.height / 2),
                width: 100,
                height: 230
            };

            // helper posisi mouse
            function getMousePos(e) {
                const rect = canvas.getBoundingClientRect();
                const scaleX = canvas.width / rect.width;
                const scaleY = canvas.height / rect.height;
                return {
                    x: (e.clientX - rect.left) * scaleX,
                    y: (e.clientY - rect.top) * scaleY
                };
            }

            setTimeout(() => {
                function getInstructions() {
                    switch (currentStage) {
                        case 1:
                            return "Instruksi: Nyalakan spiritus terlebih dahulu.";
                        case 2:
                            return "Instruksi: Miringkan tabung bakteri sekitar 30° ke kanan (ke area api spiritus).";
                        case 3:
                            return "Instruksi: Drag ose bulat ke tabung bakteri untuk mengambil spesimen.";
                        case 4:
                            return "Instruksi: Tahap selesai! Lanjut ke tahap berikutnya.";
                        default:
                            return "Instruksi: Ikuti petunjuk di layar.";
                    }
                }

                function drawScene() {
                    if (!sceneActive) return;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "#ededed";
                    ctx.fillRect(0, 0, canvas.width, canvas.height);

                    ctx.fillStyle = "black";
                    ctx.font = "bold 24px Poppins";
                    ctx.textAlign = "start";
                    ctx.fillText("Langkah 3: Ambil Spesimen Bakteri", 20, 40);

                    ctx.font = "18px Poppins";
                    ctx.fillText(getInstructions(), 20, 80);

                    ctx.font = "16px Poppins";
                    ctx.fillText(`Ose Bulat: ${oseHasBakteri ? 'Spesimen Bakteri Sudah Terambil' : 'Spesimen Bakteri Belum Terambil'}`, 20, 120);

                    // spiritus
                    if (spiritusOn) {
                        ctx.drawImage(imgSpiritus, (canvas.width / 2) - 150, (canvas.height / 2) + 102, 300, 300);
                    } else {
                        ctx.drawImage(imgSpiritusMati, (canvas.width / 2) - 150, (canvas.height / 2) + 102, 300, 300);
                    }

                    // tabung dengan rotasi
                    ctx.save();
                    ctx.translate(tabungArea.x + tabungArea.width / 2, tabungArea.y + tabungArea.height / 2);
                    ctx.rotate(tabungAngle * Math.PI / 180);
                    ctx.drawImage(imgTabungHomogen, -tabungArea.width / 2, -tabungArea.height / 2, tabungArea.width, tabungArea.height);
                    ctx.restore();

                    // ose
                    if (oseVisible) {
                        if (oseHasBakteri) {
                            ctx.drawImage(imgOseBakteri, ose.x, ose.y, ose.width, ose.height);
                        } else {
                            ctx.drawImage(imgOse, ose.x, ose.y, ose.width, ose.height);
                        }
                    }

                    // tombol spiritus
                    if (currentStage === 1) {
                        ctx.fillStyle = spiritusOn ? "green" : "red";
                        ctx.fillRect(button.x, button.y + 45, button.width, button.height);
                        ctx.fillStyle = "white";
                        ctx.font = "16px Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText(spiritusOn ? "Matikan" : "Nyalakan", button.x + button.width / 2, button.y + 65);
                    }

                    // tombol ambil
                    if (showAmbilButton && currentStage === 3) {
                        ctx.fillStyle = "#4CAF50";
                        ctx.fillRect(ambilButton.x, ambilButton.y, ambilButton.width, ambilButton.height);
                        ctx.fillStyle = "white";
                        ctx.font = "16px Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText("Ambil Spesimen Bakteri", ambilButton.x + ambilButton.width / 2, ambilButton.y + 25);
                    }

                    // tombol next
                    if (showNextButton && currentStage === 4) {
                        ctx.fillStyle = "#2196F3";
                        ctx.fillRect(nextButton.x, nextButton.y, nextButton.width, nextButton.height);
                        ctx.fillStyle = "white";
                        ctx.font = "16px Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText("Selanjutnya", nextButton.x + nextButton.width / 2, nextButton.y + 20);
                    }
                }

                function checkOseTabungCollision() {
                    return (ose.x + ose.width > tabungArea.x &&
                        ose.x < tabungArea.x + tabungArea.width &&
                        ose.y + ose.height > tabungArea.y &&
                        ose.y < tabungArea.y + tabungArea.height);
                }

                function clickHandler(e) {
                    if (!sceneActive) return;
                    e.preventDefault();
                    e.stopPropagation();

                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    // tahap 1: toggle spiritus
                    if (currentStage === 1) {
                        const spiritusBtn = {
                            x: button.x,
                            y: button.y + 45,
                            width: button.width,
                            height: button.height
                        };
                        if (mouseX >= spiritusBtn.x && mouseX <= spiritusBtn.x + spiritusBtn.width &&
                            mouseY >= spiritusBtn.y && mouseY <= spiritusBtn.y + spiritusBtn.height) {

                            spiritusOn = !spiritusOn;

                            if (spiritusOn) {
                                // 🔊 mainkan sound spiritus looping
                                sfxApi.loop = true;
                                sfxApi.currentTime = 0;
                                sfxApi.play();
                                currentStage = 2;
                            } else {
                                // 🔇 matikan jika user klik matikan
                                sfxApi.pause();
                                sfxApi.currentTime = 0;
                            }
                            drawScene();
                        }
                    }

                    // tahap 2: klik tabung → tambah rotasi + suara kocok
                    if (currentStage === 2) {
                        if (mouseX >= tabungArea.x && mouseX <= tabungArea.x + tabungArea.width &&
                            mouseY >= tabungArea.y && mouseY <= tabungArea.y + tabungArea.height) {

                            // 🔊 mainkan suara kocok sekali
                            sfxKocok.currentTime = 0;
                            sfxKocok.play();

                            tabungAngle += 10;
                            if (tabungAngle >= 30) {
                                tabungAngle = 30;
                                currentStage = 3;
                            }
                            drawScene();
                        }
                    }

                    // tahap 3
                    if (showAmbilButton && currentStage === 3) {
                        if (mouseX >= ambilButton.x && mouseX <= ambilButton.x + ambilButton.width &&
                            mouseY >= ambilButton.y && mouseY <= ambilButton.y + ambilButton.height) {
                            oseHasBakteri = true;
                            showAmbilButton = false;
                            currentStage = 4;
                            showNextButton = true;
                            drawScene();
                        }
                    }

                    // tahap 4
                    if (showNextButton && currentStage === 4) {
                        if (mouseX >= nextButton.x && mouseX <= nextButton.x + nextButton.width &&
                            mouseY >= nextButton.y && mouseY <= nextButton.y + nextButton.height) {

                            // 🔇 stop semua sound ketika pindah scene
                            sfxApi.pause();
                            sfxApi.currentTime = 0;

                            sceneActive = false;
                            cleanupScene5();
                            currentScene = 5; // lanjut ke scene berikutnya
                            scenes[currentScene]();
                            return;
                        }
                    }
                }

                function mouseDownHandler(e) {
                    if (!oseVisible || currentStage !== 3 || !sceneActive) return;
                    e.preventDefault();
                    e.stopPropagation();

                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    if (mouseX >= ose.x && mouseX <= ose.x + ose.width &&
                        mouseY >= ose.y && mouseY <= ose.y + ose.height) {
                        isDragging = true;
                        offsetX = mouseX - ose.x;
                        offsetY = mouseY - ose.y;
                    }
                }

                function mouseMoveHandler(e) {
                    if (!isDragging || currentStage !== 3 || !sceneActive) return;
                    e.preventDefault();

                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    ose.x = mouseX - offsetX;
                    ose.y = mouseY - offsetY;

                    showAmbilButton = checkOseTabungCollision();
                    drawScene();
                }

                function mouseUpHandler() {
                    if (!sceneActive) return;
                    isDragging = false;
                }

                function cleanupScene5() {
                    canvas.removeEventListener("click", clickHandler);
                    canvas.removeEventListener("mousedown", mouseDownHandler);
                    canvas.removeEventListener("mousemove", mouseMoveHandler);
                    canvas.removeEventListener("mouseup", mouseUpHandler);
                    canvas.removeEventListener("mouseleave", mouseUpHandler);

                    // 🔇 stop sound juga saat cleanup
                    sfxApi.pause();
                    sfxApi.currentTime = 0;
                    sfxKocok.pause();
                    sfxKocok.currentTime = 0;
                }

                // simpan handler
                canvas.scene5Click = clickHandler;
                canvas.scene5MouseDown = mouseDownHandler;
                canvas.scene5MouseMove = mouseMoveHandler;
                canvas.scene5MouseUp = mouseUpHandler;

                canvas.addEventListener("click", clickHandler);
                canvas.addEventListener("mousedown", mouseDownHandler);
                canvas.addEventListener("mousemove", mouseMoveHandler);
                canvas.addEventListener("mouseup", mouseUpHandler);
                canvas.addEventListener("mouseleave", mouseUpHandler);

                let offsetX = 0,
                    offsetY = 0;
                drawScene();
            }, 1500);
        },

        function scene6() {
            cleanupAllEventListeners();
            // Transition overlay
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "rgba(0,0,0,0.8)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "white";
            ctx.font = "bold 28px Poppins";
            ctx.textAlign = "center";
            ctx.fillText("Tahap 4: Inokulasi Goresan", canvas.width / 2, canvas.height / 2 - 20);
            ctx.font = "20px Poppins";
            ctx.fillText("Menggores pada Nutrient Agar (NA)", canvas.width / 2, canvas.height / 2 + 20);

            setTimeout(() => {
                // STATE - menggunakan global sceneActive
                let sceneActive = true;
                let scene6Active = true;
                let isDragging = false;
                let showButton = false;
                let offsetX = 0;
                let offsetY = 0;

                if (sfxApi) {
                    sfxApi.loop = true;
                    sfxApi.currentTime = 0;
                    sfxApi.play().catch(err => console.log("Audio play blocked:", err));
                }

                // Ose
                let ose = {
                    x: canvas.width / 2 - 50,
                    y: canvas.height / 2 - 100,
                    width: 400,
                    height: 50
                };

                // Area cawan - diperbesar
                let cawaArea = {
                    x: (canvas.width / 2) - 200,
                    y: (canvas.height / 2) + 30,
                    width: 200,
                    height: 80
                };

                // --- Fungsi utilitas ---
                function getMousePos(e) {
                    const rect = canvas.getBoundingClientRect();
                    const scaleX = canvas.width / rect.width;
                    const scaleY = canvas.height / rect.height;
                    return {
                        x: (e.clientX - rect.left) * scaleX,
                        y: (e.clientY - rect.top) * scaleY
                    };
                }

                function isOseInCawan() {
                    let oseLeft = ose.x;
                    let oseTop = ose.y + ose.height / 2;
                    return (
                        oseLeft >= cawaArea.x &&
                        oseLeft <= cawaArea.x + cawaArea.width &&
                        oseTop >= cawaArea.y &&
                        oseTop <= cawaArea.y + cawaArea.height
                    );
                }

                // --- Mode Drag Drop ---
                function drawDragScene() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "#ededed";
                    ctx.fillRect(0, 0, canvas.width, canvas.height);

                    ctx.fillStyle = "black";
                    ctx.font = "bold 24px Poppins";
                    ctx.textAlign = "start";
                    ctx.fillText("Langkah 4: Menggesekkan Spesimen ke Media Padat", 20, 40);
                    ctx.font = "18px Poppins";
                    ctx.fillText("Instruksi: Arahkan ose dengan bakteri ke cawan agar (NA)", 20, 70);

                    // Draw spiritus burner
                    ctx.drawImage(imgSpiritus, (canvas.width / 2) - 150, (canvas.height / 2) + 102, 300, 300);

                    // Draw cawan with circular area
                    ctx.drawImage(imgCawan, cawaArea.x, cawaArea.y, cawaArea.width, cawaArea.height);

                    // Draw ose
                    ctx.drawImage(imgOseBakteri, ose.x, ose.y, ose.width, ose.height);

                    if (showButton) {
                        ctx.fillStyle = "#4CAF50";
                        ctx.fillRect(canvas.width / 2 - 100, canvas.height - 80, 200, 40);
                        ctx.fillStyle = "white";
                        ctx.font = "18px Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText("Mulai Penggoresan", canvas.width / 2, canvas.height - 55);
                    }
                }

                function dragClickHandler(e) {
                    if (!scene6Active) return;
                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    if (showButton &&
                        mouseX >= canvas.width / 2 - 100 && mouseX <= canvas.width / 2 + 100 &&
                        mouseY >= canvas.height - 80 && mouseY <= canvas.height - 40) {
                        if (sfxApi) {
                            sfxApi.pause();
                            sfxApi.currentTime = 0;
                        }
                        cleanupDrag();
                        activateDrawing();
                    }
                }

                function dragMouseDown(e) {
                    if (!scene6Active) return;
                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    if (mouseX >= ose.x + (2 * ose.width / 3) && mouseX <= ose.x + ose.width &&
                        mouseY >= ose.y && mouseY <= ose.y + ose.height) {
                        isDragging = true;
                        offsetX = mouseX - ose.x;
                        offsetY = mouseY - ose.y;
                    }
                }

                function dragMouseMove(e) {
                    if (!isDragging || !scene6Active) return;
                    const {
                        x: mouseX,
                        y: mouseY
                    } = getMousePos(e);

                    ose.x = Math.max(0, Math.min(canvas.width - ose.width, mouseX - offsetX));
                    ose.y = Math.max(0, Math.min(canvas.height - ose.height, mouseY - offsetY));

                    showButton = isOseInCawan();
                    drawDragScene();
                }

                function dragMouseUp() {
                    isDragging = false;
                }

                function cleanupDrag() {
                    canvas.removeEventListener("click", dragClickHandler);
                    canvas.removeEventListener("mousedown", dragMouseDown);
                    canvas.removeEventListener("mousemove", dragMouseMove);
                    canvas.removeEventListener("mouseup", dragMouseUp);
                    canvas.removeEventListener("mouseleave", dragMouseUp);
                }

                // Pasang listener drag
                canvas.addEventListener("click", dragClickHandler);
                canvas.addEventListener("mousedown", dragMouseDown);
                canvas.addEventListener("mousemove", dragMouseMove);
                canvas.addEventListener("mouseup", dragMouseUp);
                canvas.addEventListener("mouseleave", dragMouseUp);

                if (typeof window.currentSceneCleanup !== 'undefined') {
                    window.currentSceneCleanup();
                }
                window.currentSceneCleanup = cleanupDrag;

                drawDragScene();

                // --- Mode Zigzag Arsiran ---
                function activateDrawing() {
                    let drawingActive = true;
                    let isDrawing = false;
                    let currentStep = 0;
                    let lastDrawPoint = null;
                    let strokeCount = 0;
                    let requiredStrokes = [20, 15, 15];

                    // Variable untuk tombol selanjutnya
                    let nextButtonClickHandler = null;

                    const centerX = canvas.width / 2;
                    const centerY = canvas.height / 2;
                    const radius = 180;

                    // Define areas with proper angles and coverage
                    let areas = [{
                            name: "Area Pertama (50%)",
                            startAngle: -Math.PI / 2,
                            endAngle: Math.PI / 2,
                            completed: false,
                            strokePoints: [],
                            color: "black",
                            coverage: 0
                        },
                        {
                            name: "Area Kedua (25%)",
                            startAngle: Math.PI / 2,
                            endAngle: Math.PI,
                            completed: false,
                            strokePoints: [],
                            color: "black",
                            coverage: 0
                        },
                        {
                            name: "Area Ketiga (25%)",
                            startAngle: Math.PI,
                            endAngle: 3 * Math.PI / 2,
                            completed: false,
                            strokePoints: [],
                            color: "black",
                            coverage: 0
                        }
                    ];

                    function isPointInArea(x, y, areaIndex) {
                        const dx = x - centerX;
                        const dy = y - centerY;
                        const distance = Math.sqrt(dx * dx + dy * dy);

                        if (distance > radius || distance < 30) return false;

                        let angle = Math.atan2(dy, dx);
                        if (angle < 0) angle += 2 * Math.PI;

                        const area = areas[areaIndex];
                        let startAngle = area.startAngle;
                        let endAngle = area.endAngle;

                        if (startAngle < 0) startAngle += 2 * Math.PI;
                        if (endAngle < 0) endAngle += 2 * Math.PI;

                        if (areaIndex === 0) {
                            return (angle >= 0 && angle <= Math.PI / 2) || (angle >= 3 * Math.PI / 2 && angle <= 2 * Math.PI);
                        } else if (areaIndex === 1) {
                            return angle >= Math.PI / 2 && angle <= Math.PI;
                        } else if (areaIndex === 2) {
                            return angle >= Math.PI && angle <= 3 * Math.PI / 2;
                        }

                        return false;
                    }

                    function calculateCoverage(areaIndex) {
                        const area = areas[areaIndex];
                        const points = area.strokePoints;

                        if (points.length === 0) return 0;

                        const gridSize = 8;
                        const coveredCells = new Set();

                        points.forEach(point => {
                            const gridX = Math.floor(point.x / gridSize);
                            const gridY = Math.floor(point.y / gridSize);
                            coveredCells.add(`${gridX},${gridY}`);
                        });

                        let expectedCells = 0;
                        if (areaIndex === 0) expectedCells = 80;
                        else expectedCells = 40;

                        return Math.min(100, (coveredCells.size / expectedCells) * 100);
                    }

                    function drawAreas() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.fillStyle = "#f8f9fa";
                        ctx.fillRect(0, 0, canvas.width, canvas.height);

                        // Title and instructions
                        ctx.fillStyle = "black";
                        ctx.font = "bold 22px Poppins";
                        ctx.textAlign = "start";
                        ctx.fillText("Teknik Pengarsiran Kuadran", 20, 35);

                        ctx.font = "16px Poppins";
                        ctx.fillText(`Tahap ${currentStep + 1}: ${areas[currentStep].name}`, 20, 60);
                        ctx.fillText(`Progress: ${Math.round(areas[currentStep].coverage)}% | Goresan: ${strokeCount}/${requiredStrokes[currentStep]}`, 20, 85);

                        // Draw petri dish background - dengan border hitam yang jelas
                        ctx.fillStyle = "black";
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, radius + 5, 0, Math.PI * 2);
                        ctx.fill();

                        ctx.fillStyle = "black";
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                        ctx.fill();

                        ctx.strokeStyle = "black";
                        ctx.lineWidth = 3;
                        ctx.stroke();

                        // Draw all areas with different colors
                        areas.forEach((area, index) => {
                            ctx.fillStyle = area.color;
                            ctx.beginPath();
                            ctx.moveTo(centerX, centerY);

                            if (index === 0) {
                                ctx.arc(centerX, centerY, radius, -Math.PI / 2, Math.PI / 2);
                            } else if (index === 1) {
                                ctx.arc(centerX, centerY, radius, Math.PI / 2, Math.PI);
                            } else if (index === 2) {
                                ctx.arc(centerX, centerY, radius, Math.PI, 3 * Math.PI / 2);
                            }

                            ctx.closePath();
                            ctx.fill();

                            if (index === currentStep) {
                                ctx.strokeStyle = "#ff0000";
                                ctx.lineWidth = 4;
                                ctx.stroke();
                                ctx.strokeStyle = "#000";
                                ctx.lineWidth = 1;
                            }
                        });

                        ctx.fillStyle = "#666";
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, 5, 0, Math.PI * 2);
                        ctx.fill();

                        // Draw all stroke points
                        areas.forEach((area, index) => {
                            if (area.strokePoints.length > 0) {
                                ctx.fillStyle = index === 0 ? "#8B0000" : (index === 1 ? "#006400" : "#000080");
                                area.strokePoints.forEach(point => {
                                    ctx.beginPath();
                                    ctx.arc(point.x, point.y, 3, 0, Math.PI * 2);
                                    ctx.fill();
                                });
                            }
                        });

                        // Draw progress indicators
                        ctx.fillStyle = "rgba(255,255,255,0.95)";
                        ctx.fillRect(20, canvas.height - 140, 320, 120);
                        ctx.strokeStyle = "black";
                        ctx.lineWidth = 2;
                        ctx.strokeRect(20, canvas.height - 140, 320, 120);

                        ctx.fillStyle = "black";
                        ctx.font = "bold 16px Poppins";
                        ctx.fillText("Progress Pengarsiran:", 30, canvas.height - 115);

                        areas.forEach((area, index) => {
                            const y = canvas.height - 90 + (index * 25);
                            const status = area.completed ? "✓ SELESAI" : (index === currentStep ? "→ AKTIF" : "○ MENUNGGU");
                            const color = area.completed ? "green" : (index === currentStep ? "red" : "gray");

                            ctx.fillStyle = color;
                            ctx.font = "14px Poppins";
                            ctx.fillText(`${status} - ${area.name}: ${Math.round(area.coverage)}%`, 30, y);
                        });
                    }

                    function drawPattern(x, y) {
                        if (isPointInArea(x, y, currentStep)) {
                            areas[currentStep].strokePoints.push({
                                x,
                                y
                            });

                            if (lastDrawPoint) {
                                const distance = Math.sqrt(Math.pow(x - lastDrawPoint.x, 2) + Math.pow(y - lastDrawPoint.y, 2));
                                if (distance > 12) {
                                    strokeCount++;
                                    lastDrawPoint = {
                                        x,
                                        y
                                    };
                                }
                            } else {
                                strokeCount++;
                                lastDrawPoint = {
                                    x,
                                    y
                                };
                            }

                            areas[currentStep].coverage = calculateCoverage(currentStep);

                            ctx.fillStyle = currentStep === 0 ? "#8B0000" : (currentStep === 1 ? "#006400" : "#000080");
                            ctx.beginPath();
                            ctx.arc(x, y, 3, 0, Math.PI * 2);
                            ctx.fill();

                            if (areas[currentStep].strokePoints.length % 3 === 0) {
                                drawAreas();
                            }
                        }
                    }

                    function drawingMouseDown(e) {
                        if (!drawingActive) return;
                        const {
                            x,
                            y
                        } = getMousePos(e);
                        isDrawing = true;
                        drawPattern(x, y);
                    }

                    function drawingMouseMove(e) {
                        if (!drawingActive || !isDrawing) return;
                        const {
                            x,
                            y
                        } = getMousePos(e);
                        drawPattern(x, y);
                    }

                    function drawingMouseUp() {
                        if (!drawingActive) return;
                        isDrawing = false;
                        lastDrawPoint = null;

                        const minCoverage = 50;
                        const minStrokes = requiredStrokes[currentStep];

                        if (areas[currentStep].coverage >= minCoverage && strokeCount >= minStrokes) {
                            areas[currentStep].completed = true;

                            if (currentStep < areas.length - 1) {
                                currentStep++;
                                strokeCount = 0;
                                drawAreas();
                            } else {
                                finishDrawing();
                            }
                        } else {
                            ctx.fillStyle = "rgba(255,255,0,0.9)";
                            ctx.fillRect(centerX - 180, centerY - 60, 360, 50);
                            ctx.strokeStyle = "black";
                            ctx.strokeRect(centerX - 180, centerY - 60, 360, 50);
                            ctx.fillStyle = "black";
                            ctx.font = "bold 16px Poppins";
                            ctx.textAlign = "center";
                            ctx.fillText(`Butuh lebih banyak goresan! (${strokeCount}/${minStrokes}, Coverage: ${Math.round(areas[currentStep].coverage)}%/${minCoverage}%)`, centerX, centerY - 30);

                            setTimeout(() => {
                                drawAreas();
                            }, 2500);
                        }
                    }

                    function finishDrawing() {
                        console.log("🎯 finishDrawing() dipanggil");

                        // STEP 1: Cleanup drawing event listeners terlebih dahulu
                        canvas.removeEventListener("mousedown", drawingMouseDown);
                        canvas.removeEventListener("mousemove", drawingMouseMove);
                        canvas.removeEventListener("mouseup", drawingMouseUp);
                        drawingActive = false;

                        // STEP 2: Gambar tombol selanjutnya
                        const btnX = canvas.width / 2 - 100;
                        const btnY = canvas.height - 100;
                        const btnW = 200;
                        const btnH = 50;
                        ctx.fillStyle = "#87CBB9";
                        ctx.fillRect(btnX, btnY, btnW, btnH);
                        ctx.fillStyle = "white";
                        ctx.font = "bold 20px Poppins";
                        ctx.textAlign = "center";
                        ctx.textBaseline = "middle";
                        ctx.fillText("Lanjutkan", btnX + btnW / 2, btnY + btnH / 2);

                        console.log(`📍 Tombol digambar di: x=${btnX}, y=${btnY}, w=${btnW}, h=${btnH}`);

                        // STEP 3: Buat event handler untuk tombol next
                        nextButtonClickHandler = function(e) {
                            const {
                                x,
                                y
                            } = getMousePos(e);
                            console.log(`🖱️ Click terdeteksi di: x=${x}, y=${y}`);
                            console.log(`📊 Area tombol: x=${btnX}-${btnX + btnW}, y=${btnY}-${btnY + btnH}`);

                            if (x >= btnX && x <= btnX + btnW &&
                                y >= btnY && y <= btnY + btnH) {
                                console.log("✅ Tombol 'Selanjutnya' diklik!");

                                // Cleanup terlebih dahulu sebelum pindah scene
                                // cleanupAllEventListeners(); 
                                sceneActive = false;
                                cleanupScene6();

                                // pakai sistem scenes[]
                                currentScene = 6; // index scene6
                                scenes[currentScene](); // otomatis ke scene7
                            };
                        }

                        // STEP 4: Pasang event listener untuk tombol
                        canvas.addEventListener("click", nextButtonClickHandler);
                        console.log("🎯 Event listener untuk tombol 'Selanjutnya' dipasang");

                        // STEP 5: Update cleanup reference
                        window.currentSceneCleanup = cleanupScene;
                    }

                    // Fungsi cleanup lengkap untuk scene6
                    function cleanupScene6() {
                        console.log("🧹 Cleanup scene6");

                        // drag
                        canvas.removeEventListener("click", dragClickHandler);
                        canvas.removeEventListener("mousedown", dragMouseDown);
                        canvas.removeEventListener("mousemove", dragMouseMove);
                        canvas.removeEventListener("mouseup", dragMouseUp);

                        // drawing
                        canvas.removeEventListener("mousedown", drawingMouseDown);
                        canvas.removeEventListener("mousemove", drawingMouseMove);
                        canvas.removeEventListener("mouseup", drawingMouseUp);

                        // tombol next
                        if (nextButtonClickHandler) {
                            canvas.removeEventListener("click", nextButtonClickHandler);
                            nextButtonClickHandler = null;
                        }
                    }


                    // // Setup drawing event listeners
                    canvas.addEventListener("mousedown", drawingMouseDown);
                    canvas.addEventListener("mousemove", drawingMouseMove);
                    canvas.addEventListener("mouseup", drawingMouseUp);

                    // Update cleanup reference
                    // window.currentSceneCleanup = cleanupScene6;

                    drawAreas();
                }
            }, 1500);
        },

        function scene7() {
            console.log("🚀 Scene7 started");

            if (window.currentSceneCleanup) {
                console.log("🧹 Cleaning up previous scene");
                window.currentSceneCleanup();
            }
            sceneActive = true;

            // Cek apakah canvas dan ctx tersedia
            if (!canvas) {
                console.error("❌ Canvas not found!");
                return;
            }
            if (!ctx) {
                console.error("❌ Context not found!");
                return;
            }

            // Transition overlay
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "rgba(0,0,0,0.8)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "white";
            ctx.font = "bold 28px Poppins";
            ctx.textAlign = "center";
            ctx.fillText("Tahap 5: Inokulasi Goresan", canvas.width / 2, canvas.height / 2 - 20);
            ctx.font = "20px Poppins";
            ctx.fillText("Menginkubasi hasil goresan di inkubator", canvas.width / 2, canvas.height / 2 + 20);

            console.log("✅ Transition overlay drawn");

            setTimeout(() => {
                if (!sceneActive) {
                    console.log("⚠️ Scene no longer active, stopping");
                    return;
                }

                console.log("🎬 Starting main scene content");

                // State variables untuk scene ini
                let cawaPos = {
                    x: canvas.width / 2,
                    y: canvas.height / 2 + 300
                };
                let cawaSize = {
                    width: 200,
                    height: 80
                };
                let inkubatorArea = {
                    x: canvas.width / 2 - 500,
                    y: canvas.height / 2,
                    width: 350,
                    height: 600
                };
                let isIncubating = false;
                let countdown = 24; // 24 detik
                let countdownInterval;
                let cawaHidden = false;
                let showHasilButton = false;

                console.log("📍 Initial positions:", {
                    cawa: cawaPos,
                    inkubator: inkubatorArea
                });

                function drawScene() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "#ededed";
                    ctx.fillRect(0, 0, canvas.width, canvas.height);

                    ctx.fillStyle = "black";
                    ctx.font = "bold 24px Poppins";
                    ctx.textAlign = "start";
                    ctx.fillText("Langkah 5: Inkubasi media plate di inkubator", 20, 40);

                    ctx.font = "20px Poppins";
                    let instruksi = "Instruksi: Klik tombol 'Mulai Inkubasi' untuk memulai proses inkubasi";
                    ctx.fillText(instruksi, 20, 80);

                    // Gambar inkubator
                    if (typeof imgInkubator !== 'undefined' && imgInkubator.complete) {
                        ctx.drawImage(imgInkubator, inkubatorArea.x, inkubatorArea.y, inkubatorArea.width, inkubatorArea.height);
                    } else {
                        console.warn("⚠️ imgInkubator not loaded, drawing placeholder");
                        ctx.fillStyle = "#666";
                        ctx.fillRect(inkubatorArea.x, inkubatorArea.y, inkubatorArea.width, inkubatorArea.height);
                        ctx.fillStyle = "white";
                        ctx.font = "20px Arial";
                        ctx.textAlign = "center";
                        ctx.fillText("INKUBATOR", inkubatorArea.x + inkubatorArea.width / 2, inkubatorArea.y + inkubatorArea.height / 2);
                    }

                    // Gambar cawan jika tidak hidden
                    if (!cawaHidden) {
                        if (typeof imgCawan !== 'undefined' && imgCawan.complete) {
                            ctx.drawImage(imgCawan, cawaPos.x, cawaPos.y, cawaSize.width, cawaSize.height);
                        } else {
                            console.warn("⚠️ imgCawan not loaded, drawing placeholder");
                            ctx.fillStyle = "#ff6b6b";
                            ctx.fillRect(cawaPos.x, cawaPos.y, cawaSize.width, cawaSize.height);
                            ctx.fillStyle = "white";
                            ctx.font = "16px Arial";
                            ctx.textAlign = "center";
                            ctx.fillText("CAWAN", cawaPos.x + cawaSize.width / 2, cawaPos.y + cawaSize.height / 2);
                        }
                    }

                    // Tombol mulai inkubasi (selalu muncul jika belum inkubasi)
                    if (!isIncubating && !showHasilButton) {
                        ctx.fillStyle = "#4CAF50";
                        ctx.fillRect(inkubatorArea.x + 50, inkubatorArea.y - 80, 250, 50);
                        ctx.fillStyle = "white";
                        ctx.font = "bold 20px Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText("Mulai Inkubasi", inkubatorArea.x + 175, inkubatorArea.y - 50);
                    }

                    // Countdown jika sedang inkubasi
                    if (isIncubating && countdown > 0) {
                        ctx.fillStyle = "rgba(0,0,0,0.7)";
                        ctx.fillRect(inkubatorArea.x + 75, inkubatorArea.y - 100, 200, 80);
                        ctx.fillStyle = "white";
                        ctx.font = "bold 24px Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText("Inkubasi...", inkubatorArea.x + 175, inkubatorArea.y - 70);
                        ctx.font = "bold 32px Poppins";
                        ctx.fillText(countdown + "s", inkubatorArea.x + 175, inkubatorArea.y - 40);
                    }

                    // Tombol lihat hasil di tengah layar
                    if (showHasilButton) {
                        ctx.fillStyle = "#2196F3";
                        ctx.fillRect(canvas.width / 2 - 100, canvas.height / 2 - 25, 200, 50);
                        ctx.fillStyle = "white";
                        ctx.font = "bold 20px Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText("Lihat Hasil", canvas.width / 2, canvas.height / 2 + 5);
                    }
                }

                function getMousePos(evt) {
                    const rect = canvas.getBoundingClientRect();
                    return {
                        x: (evt.clientX - rect.left) * (canvas.width / rect.width),
                        y: (evt.clientY - rect.top) * (canvas.height / rect.height)
                    };
                }

                function isPointInRect(px, py, rx, ry, rw, rh) {
                    return px >= rx && px <= rx + rw && py >= ry && py <= ry + rh;
                }

                function mouseClick(e) {
                    const pos = getMousePos(e);

                    console.log("🖱️ Click at:", pos.x, pos.y);

                    // Klik tombol mulai inkubasi
                    if (!isIncubating && !showHasilButton &&
                        isPointInRect(pos.x, pos.y, inkubatorArea.x + 50, inkubatorArea.y - 80, 250, 50)) {
                        console.log("🧪 Starting incubation");
                        startIncubation();
                    }

                    // Klik tombol lihat hasil
                    if (showHasilButton &&
                        isPointInRect(pos.x, pos.y, canvas.width / 2 - 100, canvas.height / 2 - 25, 200, 50)) {
                        console.log("➡️ Lanjut ke scene berikutnya");
                        sceneActive = false;
                        if (window.currentSceneCleanup) window.currentSceneCleanup();
                        // pakai sistem scenes[] 
                        currentScene = 7;
                        // index scene6
                        scenes[currentScene]();
                        // TODO: panggil scene8() nanti
                    }
                }

                function startIncubation() {
                    isIncubating = true;
                    cawaHidden = true; // Sembunyikan cawan

                    try {
                        sfx24Detik.currentTime = 0; // mulai dari awal
                        sfx24Detik.play().catch(err => console.warn("⚠️ Audio autoplay blocked:", err));
                        console.log("🎵 sfx24Detik started");
                    } catch (err) {
                        console.error("❌ Error playing sfx24Detik:", err);
                    }

                    console.log("⏰ Starting countdown from", countdown);

                    // Mulai countdown
                    countdownInterval = setInterval(() => {
                        countdown--;
                        console.log("⏰ Countdown:", countdown);
                        drawScene();

                        if (countdown <= 0) {
                            clearInterval(countdownInterval);
                            console.log("✅ Incubation complete!");
                            sfx24Detik.pause();
                            sfx24Detik.currentTime = 0;
                            // Tampilkan tombol lihat hasil
                            showHasilButton = true;
                            drawScene();
                        }
                    }, 1000);

                    // Redraw untuk update tampilan
                    drawScene();
                }

                // Add event listener
                canvas.addEventListener("click", mouseClick);

                console.log("👂 Event listener added");

                // cleanup scene7
                window.currentSceneCleanup = function cleanupScene7() {
                    console.log("🧹 Starting Scene7 cleanup");

                    canvas.removeEventListener("click", mouseClick);

                    // Bersihkan interval jika masih berjalan
                    if (countdownInterval) {
                        clearInterval(countdownInterval);
                    }

                    sceneActive = false;

                    console.log("✅ Scene7 cleanup done");
                };

                // Initial draw
                drawScene();
                console.log("🎨 Initial scene drawn");
            }, 1500);
        },

        function scene8() {
            console.log("🚀 Scene8 started");

            if (window.currentSceneCleanup) {
                console.log("🧹 Cleaning up previous scene");
                window.currentSceneCleanup();
            }
            sceneActive = true;

            if (!canvas || !ctx) {
                console.error("❌ Canvas or context not found!");
                return;
            }

            // Transition overlay
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "rgba(0,0,0,0.8)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "white";
            ctx.font = "bold 28px Poppins";
            ctx.textAlign = "center";
            ctx.fillText("Tahap 6: Inokulasi Goresan", canvas.width / 2, canvas.height / 2 - 20);
            ctx.font = "20px Poppins";
            ctx.fillText("Lihat Hasil", canvas.width / 2, canvas.height / 2 + 20);

            setTimeout(() => {
                if (!sceneActive) return;

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = "#ededed";
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                // Judul utama
                ctx.fillStyle = "black";
                ctx.font = "bold 24px Poppins";
                ctx.textAlign = "start";
                ctx.fillText("Langkah 6: Lihat Hasil", 20, 40);

                // Gambar di kiri
                const imgX = 50;
                const imgY = 180;
                const imgWidth = 500;
                const imgHeight = 500;
                ctx.drawImage(imgHasil, imgX, imgY, imgWidth, imgHeight);

                // Teks di kanan
                const textX = imgX + imgWidth + 30; // jarak kanan gambar
                let textY = imgY + 30;
                const lineHeight = 28;

                const texts = [{
                        title: "Hasil",
                        content: "Melalui inokulasi gesekan pada bakteri E. coli, kita dapat mengetahui lima langkah utama dalam teknik ini, yaitu: persiapan bakteri, pengambilan inokulum, penggoresan pada media, isolasi koloni, dan pengamatan pertumbuhan. Metode gesekan bertujuan untuk menyebarkan bakteri secara bertahap agar koloni tunggal dapat terbentuk, memungkinkan identifikasi morfologi koloni secara jelas."
                    },
                    {
                        title: "Hasil pada bagian 50% pertama",
                        content: "Pada area 50% pertama, koloni tumbuh rapat dan berdekatan karena menerima konsentrasi bakteri paling tinggi, tampak krem hingga putih kekuningan, bulat, dan mengkilap, menunjukkan inokulum berhasil diaplikasikan."
                    },
                    {
                        title: "Hasil pada bagian 25% pertama (sekunder)",
                        content: "Pada area 25% pertama, koloni mulai tersebar lebih merata dan mulai terpisah, menandakan teknik gesekan efektif untuk isolasi awal."
                    },
                    {
                        title: "Hasil pada bagian 25% kedua (terakhir)",
                        content: "Sedangkan pada area 25% kedua, koloni sangat terisolasi sehingga hampir semua koloni tunggal, ideal untuk pengambilan sampel murni."
                    },
                    {
                        title: "Kesimpulan",
                        content: "Dari keseluruhan proses ini, dapat disimpulkan bahwa inokulasi gesekan berhasil menyebarkan bakteri dari area padat ke terisolasi, memungkinkan identifikasi morfologi koloni dan isolasi koloni tunggal untuk penelitian lanjutan."
                    }
                ];

                texts.forEach(section => {
                    ctx.font = "bold 28px Poppins";
                    ctx.fillText(section.title, textX, textY);
                    textY += lineHeight;

                    ctx.font = "16px Poppins";
                    const words = section.content.split(' ');
                    let line = '';
                    const maxWidth = canvas.width - textX - 50; // batas kanan
                    words.forEach((word) => {
                        const testLine = line + word + ' ';
                        const metrics = ctx.measureText(testLine);
                        if (metrics.width > maxWidth) {
                            ctx.fillText(line, textX, textY);
                            line = word + ' ';
                            textY += lineHeight;
                        } else {
                            line = testLine;
                        }
                    });
                    if (line) {
                        ctx.fillText(line, textX, textY);
                        textY += lineHeight + 15; // jarak antar section
                    }
                });
                document.getElementById('navigationButtons').style.display = 'flex';

            }, 1500);
        }

    ];

    document.fonts.load("28px 'Poppins'").then(() => {
        scenes[currentScene]();
    });

    // FUNGSI CLEANUP GLOBAL
    function cleanupAllEventListeners() {
        // Hapus semua listener yang mungkin tersisa
        if (canvas.scene3MouseDown) canvas.removeEventListener('mousedown', canvas.scene3MouseDown);
        if (canvas.scene3MouseMove) canvas.removeEventListener('mousemove', canvas.scene3MouseMove);
        if (canvas.scene3MouseUp) canvas.removeEventListener('mouseup', canvas.scene3MouseUp);
        if (canvas.scene4Click) canvas.removeEventListener("click", canvas.scene4Click);
        if (canvas.scene4MouseDown) canvas.removeEventListener("mousedown", canvas.scene4MouseDown);
        if (canvas.scene4MouseMove) canvas.removeEventListener("mousemove", canvas.scene4MouseMove);
        if (canvas.scene4MouseUp) canvas.removeEventListener("mouseup", canvas.scene4MouseUp);
        if (canvas.scene5Click) canvas.removeEventListener("click", canvas.scene5Click);
        if (canvas.scene5MouseDown) canvas.removeEventListener("mousedown", canvas.scene5MouseDown);
        if (canvas.scene5MouseMove) canvas.removeEventListener("mousemove", canvas.scene5MouseMove);
        if (canvas.scene5MouseUp) canvas.removeEventListener("mouseup", canvas.scene5MouseUp);
        if (canvas.scene6Click) canvas.removeEventListener("click", canvas.scene6Click);
        if (canvas.scene6MouseDown) canvas.removeEventListener("mousedown", canvas.scene6MouseDown);
        if (canvas.scene6MouseMove) canvas.removeEventListener("mousemove", canvas.scene6MouseMove);
        if (canvas.scene6MouseUp) canvas.removeEventListener("mouseup", canvas.scene6MouseUp);
        if (canvas.scene7Click) canvas.removeEventListener("click", canvas.scene6Click);
        if (canvas.scene7MouseDown) canvas.removeEventListener("mousedown", canvas.scene6MouseDown);
        if (canvas.scene7MouseMove) canvas.removeEventListener("mousemove", canvas.scene6MouseMove);
        if (canvas.scene7MouseUp) canvas.removeEventListener("mouseup", canvas.scene6MouseUp);
    }


    canvas.addEventListener("click", (e) => {
        if ((currentScene === 0 || currentScene === 1) &&
            !canvas.scene3MouseDown && !canvas.scene4Click && !canvas.scene5Click && !canvas.screen6Click && !canvas.screen7Click) {
            e.preventDefault();
            e.stopPropagation();
            currentScene++;
            if (currentScene < scenes.length) {
                scenes[currentScene]();
            }
        }
    });
</script>