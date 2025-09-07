<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Feedback - MicroLab Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/icon.png" type="image/png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-up {
            animation: slideUp 0.3s ease-out;
        }
        
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>

<body class="bg-gray-100 font-[Poppins]">

    <!-- Loading Screen -->
    <div id="loadingScreen" class="flex flex-col items-center justify-center min-h-screen text-center">
        <div class="flex justify-center items-center">
            <img src="/icon.png" class="mr-6 h-20 w-20" alt="MicroLab Icon">
            <h1 class="text-7xl font-extrabold text-[#87CBB9]">MicroLab Virtual</h1>
        </div>
        <div class="w-2/3 bg-gray-300 rounded-full h-4 overflow-hidden mt-6">
            <div id="loadingBar" class="bg-[#87CBB9] h-4 w-0 transition-all duration-200"></div>
        </div>
    </div>

    <!-- Success Notification -->
    <div id="successNotification" class="hidden fixed top-4 right-4 z-50 bg-white border-l-4 border-[#87CBB9] rounded-lg shadow-lg p-4 min-w-80">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-[#87CBB9]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">Feedback Berhasil Dikirim!</p>
                <p class="text-sm text-gray-600">Terima kasih atas masukan Anda.</p>
            </div>
            <button id="closeNotification" class="ml-auto flex-shrink-0">
                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Konten -->
    <div id="content" class="hidden opacity-0 flex transition-opacity duration-1000">
        @include('partials/sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-64">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Feedback & Saran</h1>
                    <p class="text-gray-600">Berikan masukan Anda untuk membantu kami meningkatkan kualitas MicroLab Virtual</p>
                </div>

                <!-- Feedback Form -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <form id="feedbackForm" class="space-y-6">
                        <!-- Personal Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#87CBB9] focus:border-transparent transition duration-200"
                                    placeholder="Masukkan nama lengkap anda">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#87CBB9] focus:border-transparent transition duration-200"
                                    placeholder="contoh@email.com">
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori Feedback <span class="text-red-500">*</span>
                            </label>
                            <select id="category" name="category" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#87CBB9] focus:border-transparent transition duration-200">
                                <option value="">Pilih kategori feedback</option>
                                <option value="bug">Laporan Bug</option>
                                <option value="feature">Saran Fitur</option>
                                <option value="ui">Antarmuka Pengguna</option>
                                <option value="performance">Performa Aplikasi</option>
                                <option value="content">Konten Praktikum</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Rating Keseluruhan <span class="text-red-500">*</span>
                            </label>
                            <div class="flex space-x-2" id="ratingContainer">
                                <span class="text-gray-400 text-sm mr-4">Buruk</span>
                                <div class="flex space-x-1">
                                    <button type="button" class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition duration-200" data-rating="1">★</button>
                                    <button type="button" class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition duration-200" data-rating="2">★</button>
                                    <button type="button" class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition duration-200" data-rating="3">★</button>
                                    <button type="button" class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition duration-200" data-rating="4">★</button>
                                    <button type="button" class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition duration-200" data-rating="5">★</button>
                                </div>
                                <span class="text-gray-400 text-sm ml-4">Excellent</span>
                            </div>
                            <input type="hidden" id="rating" name="rating" required>
                        </div>

                        <!-- Feedback Message -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pesan Feedback <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#87CBB9] focus:border-transparent transition duration-200"
                                placeholder="Tuliskan feedback, saran, atau keluhan Anda secara detail..."></textarea>
                            <div class="text-sm text-gray-500 mt-1">
                                Minimal 10 karakter
                            </div>
                        </div>

                        <!-- Additional Features -->
                        {{-- <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Fitur yang Paling Disukai (Opsional)
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="virtual-lab" class="rounded text-[#87CBB9] focus:ring-[#87CBB9]">
                                    <span class="text-sm text-gray-700">Laboratorium Virtual</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="simulation" class="rounded text-[#87CBB9] focus:ring-[#87CBB9]">
                                    <span class="text-sm text-gray-700">Simulasi</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="materials" class="rounded text-[#87CBB9] focus:ring-[#87CBB9]">
                                    <span class="text-sm text-gray-700">Materi Pembelajaran</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="quiz" class="rounded text-[#87CBB9] focus:ring-[#87CBB9]">
                                    <span class="text-sm text-gray-700">Kuis Interaktif</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="report" class="rounded text-[#87CBB9] focus:ring-[#87CBB9]">
                                    <span class="text-sm text-gray-700">Laporan Hasil</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="features[]" value="ui" class="rounded text-[#87CBB9] focus:ring-[#87CBB9]">
                                    <span class="text-sm text-gray-700">Antarmuka</span>
                                </label>
                            </div>
                        </div> --}}

                        <!-- Submit Button -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="submit" id="submitBtn"
                                class="flex-1 bg-[#87CBB9] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#7bb8a3] transition duration-300 focus:ring-2 focus:ring-[#87CBB9] focus:ring-offset-2">
                                <span id="submitText">Kirim Feedback</span>
                                <span id="loadingText" class="hidden">Mengirim...</span>
                            </button>
                            <button type="button" id="resetBtn"
                                class="flex-1 sm:flex-none bg-gray-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-gray-600 transition duration-300">
                                Reset Form
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Additional Information -->
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-blue-800">Informasi Penting</h3>
                            <p class="mt-1 text-sm text-blue-700">
                                Feedback Anda sangat berharga bagi kami. Tim kami akan meninjau setiap masukan yang diberikan 
                                dan berusaha untuk terus meningkatkan kualitas platform MicroLab Virtual.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Loading Screen
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

        // Rating System
        const ratingStars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('rating');
        let selectedRating = 0;

        ratingStars.forEach(star => {
            star.addEventListener('click', function(e) {
                e.preventDefault();
                selectedRating = parseInt(this.dataset.rating);
                ratingInput.value = selectedRating;
                updateStarDisplay();
            });

            star.addEventListener('mouseover', function() {
                const hoverRating = parseInt(this.dataset.rating);
                highlightStars(hoverRating);
            });
        });

        document.getElementById('ratingContainer').addEventListener('mouseleave', function() {
            updateStarDisplay();
        });

        function highlightStars(rating) {
            ratingStars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        function updateStarDisplay() {
            highlightStars(selectedRating);
        }

        // Form Submission
        const feedbackForm = document.getElementById('feedbackForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingText = document.getElementById('loadingText');
        const successNotification = document.getElementById('successNotification');
        const closeNotification = document.getElementById('closeNotification');

        feedbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate rating
            if (!ratingInput.value) {
                alert('Mohon berikan rating untuk feedback Anda!');
                return;
            }

            // Validate message length
            const message = document.getElementById('message').value;
            if (message.length < 10) {
                alert('Pesan feedback minimal 10 karakter!');
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');

            // Simulate API call
            setTimeout(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');

                // Show success notification
                showSuccessNotification();

                // Reset form
                resetForm();
            }, 2000);
        });

        // Reset Form
        const resetBtn = document.getElementById('resetBtn');
        resetBtn.addEventListener('click', resetForm);

        function resetForm() {
            feedbackForm.reset();
            selectedRating = 0;
            ratingInput.value = '';
            updateStarDisplay();
        }

        // Success Notification
        function showSuccessNotification() {
            successNotification.classList.remove('hidden');
            successNotification.classList.add('fade-in');
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                hideSuccessNotification();
            }, 5000);
        }

        function hideSuccessNotification() {
            successNotification.classList.add('opacity-0');
            setTimeout(() => {
                successNotification.classList.add('hidden');
                successNotification.classList.remove('opacity-0', 'fade-in');
            }, 300);
        }

        closeNotification.addEventListener('click', hideSuccessNotification);

        // Form Animation on Load
        window.addEventListener('load', () => {
            setTimeout(() => {
                const formElements = document.querySelectorAll('#feedbackForm > div');
                formElements.forEach((element, index) => {
                    setTimeout(() => {
                        element.classList.add('slide-up');
                    }, index * 100);
                });
            }, 1500);
        });
    </script>
</body>

</html>