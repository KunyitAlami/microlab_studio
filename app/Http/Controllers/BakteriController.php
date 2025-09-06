<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BakteriController extends Controller
{
    // === DATA DUMMY (SEMENTARA) ===
    private $bakteriData = [
        '1' => [
            'nama' => 'Escherichia coli',
            'gambar' => '/assets/bakteri/1.jpeg',
            'deskripsi' => 'Escherichia coli (biasa disingkat E. coli) adalah bakteri yang umum ditemukan di usus manusia. Sebagian besar jenis E. coli tidak berbahaya, namun beberapa strain dapat menyebabkan keracunan makanan serius.',
        ],
        '2' => [
            'nama' => 'Staphylococcus aureus',
            'gambar' => '/assets/bakteri/2.jpeg',
            'deskripsi' => 'Staphylococcus aureus adalah bakteri yang sering ditemukan pada kulit dan saluran pernapasan manusia. Bakteri ini bisa menjadi patogen oportunistik, menyebabkan infeksi kulit hingga kondisi yang lebih serius seperti pneumonia.',
        ],
        '3' => [
            'nama' => 'Salmonella enterica',
            'gambar' => '/assets/bakteri/3.jpeg',
            'deskripsi' => 'Salmonella enterica adalah bakteri penyebab utama keracunan makanan. Infeksi biasanya terjadi akibat konsumsi makanan atau air yang terkontaminasi dan dapat menyebabkan diare, demam, serta kram perut.',
        ],
        '4' => [
            'nama' => 'Bacillus subtilis',
            'gambar' => '/assets/bakteri/4.jpeg',
            'deskripsi' => 'Bacillus subtilis adalah bakteri Gram-positif yang sering ditemukan di tanah dan saluran pencernaan manusia. Bakteri ini sering digunakan sebagai model penelitian karena mudah dibudidayakan di laboratorium.',
        ],
        '5' => [
            'nama' => 'Mycobacterium tuberculosis',
            'gambar' => '/assets/bakteri/5.jpeg',
            'deskripsi' => 'Mycobacterium tuberculosis adalah bakteri penyebab penyakit tuberkulosis (TBC). Bakteri ini menyerang paru-paru tetapi juga bisa menyebar ke organ lain melalui aliran darah.',
        ],
        '6' => [
            'nama' => 'Vibrio cholerae',
            'gambar' => '/assets/bakteri/6.jpeg',
            'deskripsi' => 'Vibrio cholerae adalah bakteri penyebab penyakit kolera. Infeksi biasanya berasal dari air yang terkontaminasi dan ditandai dengan diare berat yang dapat menyebabkan dehidrasi parah.',
        ],
    ];

    // === BANK SOAL UNTUK KUIS ===
    private $quizData = [
        '1' => [ // Kuis untuk Inokulasi Goresan (id=1)
            'pre-test' => [
                'title' => 'Pre-Test: Persiapan Inokulasi Goresan',
                'questions' => [
                    1 => [
                        'question' => 'Alat utama yang digunakan untuk mengambil dan menggores bakteri pada media padat disebut...',
                        'options' => ['A' => 'Pipet', 'B' => 'Ose Bulat (Inoculating Loop)', 'C' => 'Tabung Reaksi'],
                        'correct' => 'B',
                    ],
                    2 => [
                        'question' => 'Apa tujuan utama dari teknik inokulasi goresan (streak plate)?',
                        'options' => ['A' => 'Menghitung jumlah total bakteri', 'B' => 'Memperbanyak bakteri dalam jumlah besar', 'C' => 'Mengisolasi bakteri untuk mendapatkan koloni tunggal'],
                        'correct' => 'C',
                    ],
                    3 => [
                        'question' => 'Media pertumbuhan yang umum digunakan dalam cawan petri untuk teknik ini adalah...',
                        'options' => ['A' => 'Nutrient Broth (Kaldu Nutrisi)', 'B' => 'Nutrient Agar (Agar Nutrisi)', 'C' => 'Air Suling Steril'],
                        'correct' => 'B',
                    ],
                    4 => [
                        'question' => 'Mengapa api dari pembakar spirtus/bunsen sangat penting dalam prosedur ini?',
                        'options' => ['A' => 'Untuk menerangi area kerja', 'B' => 'Untuk menciptakan kondisi aseptik (sterilisasi alat)', 'C' => 'Untuk menghangatkan media agar'],
                        'correct' => 'B',
                    ],
                ]
            ],
            'post-test' => [
                'title' => 'Post-Test: Hasil & Analisis Inokulasi Goresan',
                'questions' => [
                    1 => [
                        'question' => 'Setelah simulasi, pada goresan kuadran keberapa Anda melihat pertumbuhan koloni yang paling padat?',
                        'options' => ['A' => 'Kuadran Pertama', 'B' => 'Kuadran Kedua', 'C' => 'Kuadran Terakhir'],
                        'correct' => 'A',
                    ],
                    2 => [
                        'question' => 'Mengapa cawan petri diinkubasi dalam posisi terbalik setelah diinokulasi?',
                        'options' => ['A' => 'Agar bakteri tidak bisa keluar', 'B' => 'Mencegah uap air (kondensasi) jatuh ke permukaan media', 'C' => 'Agar lebih mudah diberi label'],
                        'correct' => 'B',
                    ],
                    3 => [
                        'question' => 'Apa yang terjadi pada jumlah bakteri yang digoreskan dari kuadran pertama ke kuadran terakhir?',
                        'options' => ['A' => 'Jumlahnya tetap sama', 'B' => 'Jumlahnya semakin banyak', 'C' => 'Jumlahnya semakin sedikit (terencerkan)'],
                        'correct' => 'C',
                    ],
                    4 => [
                        'question' => 'Koloni tunggal yang terisolasi dan murni paling mungkin didapatkan pada...',
                        'options' => ['A' => 'Area goresan pertama yang paling padat', 'B' => 'Tepi cawan petri', 'C' => 'Area goresan terakhir yang paling jarang'],
                        'correct' => 'C',
                    ],
                ]
            ]
        ]
    ];


    public function show($id)
    {
        $bakteri = $this->bakteriData[$id] ?? null;
        if (!$bakteri) {
            abort(404);
        }

        return view('detail-bakteri', ['bakteri' => $bakteri]);
    }

    public function studio($id)
    {
        $bakteri = $this->bakteriData[$id] ?? null;
        if (!$bakteri) {
            abort(404);
        }

        return view('studio', ['bakteri' => $bakteri, 'id_bakteri' => $id]);
    }

    // FUNGSI UNTUK MENAMPILKAN KUIS (SUDAH DIMODIFIKASI)
    public function showQuiz(Request $request, $id, $type)
    {
        if (!in_array($type, ['pre-test', 'post-test'])) {
            abort(404);
        }

        if ($type === 'pre-test') {
            $request->session()->forget(['pre_test_score', 'post_test_score']);
        }

        // Memilih bank soal yang sesuai (pre-test atau post-test)
        $quiz = $this->quizData[$id][$type] ?? null;
        if (!$quiz) {
            abort(404, 'Kuis untuk modul ini tidak ditemukan.');
        }

        return view('quiz', [
            'quiz' => $quiz,
            'bakteri_id' => $id,
            'type' => $type
        ]);
    }

    // FUNGSI UNTUK MEMPROSES JAWABAN KUIS (SUDAH DIMODIFIKASI)
    public function submitQuiz(Request $request, $id, $type)
    {
        $answers = $request->input('answers');
        // Memilih bank soal yang sesuai untuk validasi
        $quiz = $this->quizData[$id][$type] ?? null;

        if (!$quiz || !$answers) {
            abort(400, 'Data tidak valid.');
        }

        $score = 0;
        foreach ($quiz['questions'] as $q_id => $q_data) {
            if (isset($answers[$q_id]) && $answers[$q_id] === $q_data['correct']) {
                $score++;
            }
        }

        $totalQuestions = count($quiz['questions']);
        $percentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        if ($type === 'pre-test') {
            $request->session()->put('pre_test_score', $percentage);
            return redirect()->route('bakteri.studio', ['id' => $id]);
        } else {
            $request->session()->put('post_test_score', $percentage);
            return redirect()->route('bakteri.result', ['id' => $id]);
        }
    }

    // FUNGSI UNTUK MENAMPILKAN HASIL (TETAP SAMA)
    public function showResult(Request $request, $id)
    {
        $preTestScore = $request->session()->get('pre_test_score');
        $postTestScore = $request->session()->get('post_test_score');

        if ($preTestScore === null || $postTestScore === null) {
            return redirect('/');
        }

        return view('result', [
            'preTestScore' => $preTestScore,
            'postTestScore' => $postTestScore,
            'bakteri_id' => $id
        ]);
    }
}
