<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Kumpulan data artikel yang di-hardcode
    private $articlesData = [
        1 => [
            'id' => 1,
            'title' => 'Perbedaan Inokulasi dan Isolasi Bakteri',
            'excerpt' => 'Inokulasi adalah proses menanam bakteri, sedangkan isolasi adalah proses memisahkannya untuk mendapatkan kultur murni...',
            'content' => '
                <p>Dalam dunia mikrobiologi, istilah <strong>inokulasi</strong> dan <strong>isolasi</strong> sering digunakan, namun keduanya memiliki makna yang berbeda.</p>
                <p><strong>Inokulasi</strong> adalah proses memindahkan mikroorganisme (yang disebut inokulum) dari satu tempat ke media pertumbuhan baru (seperti media agar atau kaldu). Tujuannya adalah untuk memperbanyak atau menumbuhkan bakteri tersebut untuk berbagai keperluan, seperti penelitian atau produksi. Singkatnya, inokulasi adalah tindakan "menanam" bakteri.</p>
                <p>Sementara itu, <strong>isolasi</strong> adalah proses yang lebih spesifik untuk memisahkan satu jenis mikroorganisme dari campuran populasi yang beragam. Tujuannya adalah untuk mendapatkan koloni tunggal yang kemudian dapat dibiakkan menjadi kultur murni (hanya berisi satu spesies). Teknik goresan (streak plate) adalah salah satu metode isolasi yang paling umum digunakan.</p>
                <p>Jadi, kesimpulannya: Inokulasi adalah untuk menumbuhkan bakteri, sedangkan isolasi adalah untuk memisahkannya.</p>
            ',
            'image' => '/assets/bakteri/1.jpeg',
            'author' => 'Admin MicroLab',
            'date' => '05 September 2025'
        ],
        2 => [
            'id' => 2,
            'title' => 'Kegunaan Inkubasi pada Inokulasi Bakteri',
            'excerpt' => 'Inkubasi memberikan kondisi suhu, kelembapan, dan oksigen yang optimal agar bakteri dapat tumbuh setelah ditanam...',
            'content' => '
                <p>Setelah proses inokulasi (penanaman bakteri) selesai, langkah selanjutnya yang tidak kalah penting adalah <strong>inkubasi</strong>. Inkubasi adalah proses menyimpan kultur bakteri pada kondisi lingkungan yang terkontrol untuk jangka waktu tertentu.</p>
                <p>Tujuan utama dari inkubasi adalah untuk <strong>memberikan kondisi yang optimal</strong> bagi bakteri agar dapat tumbuh dan berkembang biak. Faktor-faktor lingkungan yang dikontrol meliputi:</p>
                <ul>
                    <li><strong>Suhu:</strong> Setiap bakteri memiliki suhu optimum untuk pertumbuhannya. Misalnya, <em>E. coli</em> tumbuh baik pada suhu 37°C, yang mirip dengan suhu tubuh manusia.</li>
                    <li><strong>Kelembapan:</strong> Kelembapan yang cukup mencegah media agar mengering.</li>
                    <li><strong>Oksigen:</strong> Ketersediaan oksigen disesuaikan dengan kebutuhan bakteri (aerobik atau anaerobik).</li>
                </ul>
                <p>Tanpa proses inkubasi yang tepat, pertumbuhan bakteri bisa sangat terhambat, memakan waktu lebih lama, atau bahkan gagal total. Oleh karena itu, inkubator menjadi alat yang esensial di setiap laboratorium mikrobiologi.</p>
            ',
            'image' => '/assets/alat/inkubator.png',
            'author' => 'Admin MicroLab',
            'date' => '05 September 2025'
        ],
        3 => [
            'id' => 3,
            'title' => 'Pentingnya Sterilisasi Ose Bulat (Loop)',
            'excerpt' => 'Sterilisasi ose bertujuan untuk membunuh semua mikroba kontaminan sebelum dan sesudah inokulasi...',
            'content' => '
                <p>Dalam teknik inokulasi, <strong>ose bulat (inoculating loop)</strong> adalah alat utama untuk memindahkan bakteri. Sebelum dan sesudah setiap pemindahan, ose wajib disterilkan. Proses sterilisasi ini biasanya dilakukan dengan memanaskannya di atas api spiritus atau Bunsen hingga seluruh kawatnya berpijar merah.</p>
                <p>Tujuan dari sterilisasi ini adalah untuk memastikan <strong>kondisi aseptik</strong>, yaitu kondisi bebas dari mikroorganisme yang tidak diinginkan. Ada dua alasan utama mengapa ini sangat penting:</p>
                <ol>
                    <li><strong>Sebelum Inokulasi:</strong> Untuk membunuh semua mikroba kontaminan yang mungkin ada di permukaan ose dari udara atau sentuhan sebelumnya. Ini memastikan bahwa hanya bakteri dari kultur sumber yang dipindahkan ke media baru.</li>
                    <li><strong>Setelah Inokulasi:</strong> Untuk membunuh sisa bakteri yang menempel pada ose setelah proses pemindahan. Ini mencegah kontaminasi pada area kerja laboratorium dan melindungi praktikan dari paparan mikroba.</li>
                </ol>
                <p>Mengabaikan sterilisasi ose dapat menyebabkan hasil kultur yang tidak valid karena terkontaminasi oleh mikroba lain.</p>
            ',
            'image' => '/assets/alat/ose_steril.png',
            'author' => 'Admin MicroLab',
            'date' => '05 September 2025'
        ],
        4 => [
            'id' => 4,
            'title' => 'Perbedaan Hasil pada Goresan Kuadran',
            'excerpt' => 'Goresan pertama menghasilkan pertumbuhan padat, sementara goresan berikutnya menghasilkan koloni yang terisolasi...',
            'content' => '
                <p>Teknik goresan kuadran (streak plate) adalah metode isolasi yang membagi cawan petri menjadi 3 atau 4 area goresan. Hasil pertumbuhan bakteri di setiap area akan berbeda secara signifikan karena prinsip pengenceran mekanis.</p>
                <ul>
                    <li><strong>Goresan Pertama (Kuadran 1):</strong> Ini adalah area di mana inokulum awal digoreskan. Pertumbuhan bakteri di sini akan terlihat <strong>sangat padat</strong>, tebal, dan seringkali menyambung (konfluen) karena konsentrasi sel bakteri paling tinggi.</li>
                    <li><strong>Goresan Kedua (Kuadran 2):</strong> Goresan ini mengambil sedikit bakteri dari ujung goresan pertama. Hasilnya, pertumbuhan bakteri akan tampak <strong>lebih jarang</strong> dibandingkan kuadran pertama. Beberapa koloni mungkin sudah mulai terlihat terpisah.</li>
                    <li><strong>Goresan Ketiga (Kuadran 3):</strong> Goresan ini mengambil dari ujung goresan kedua setelah sterilisasi ulang ose. Di area ini, pertumbuhan bakteri menjadi <strong>sangat jarang</strong>, dan idealnya, di sinilah <strong>koloni-koloni tunggal</strong> yang terpisah satu sama lain mulai terbentuk.</li>
                </ul>
                <p>Perbedaan kepadatan ini menunjukkan bahwa proses pengenceran di permukaan agar berhasil, yang merupakan kunci untuk mendapatkan kultur murni.</p>
            ',
            'image' => '/assets/alat/hasil.png',
            'author' => 'Admin MicroLab',
            'date' => '05 September 2025'
        ],
        5 => [
            'id' => 5,
            'title' => 'Perbedaan Inokulasi Cair dan Pour Plate',
            'excerpt' => 'Inokulasi cair untuk memperbanyak massa bakteri, sedangkan pour plate untuk menghitung jumlah koloni...',
            'content' => '
                <p><strong>Inokulasi cair (Broth Culture)</strong> dan <strong>Teknik Pour Plate</strong> adalah dua metode yang berbeda dengan tujuan yang berbeda pula.</p>
                <p><strong>Inokulasi Cair</strong> dilakukan dengan memasukkan bakteri ke dalam media nutrisi berbentuk cair (kaldu) di dalam tabung reaksi atau labu Erlenmeyer. Tujuannya adalah untuk <strong>memperbanyak biomassa bakteri</strong> dalam jumlah besar. Hasilnya adalah media yang menjadi keruh, menandakan pertumbuhan bakteri yang merata di seluruh volume media. Metode ini tidak digunakan untuk isolasi atau penghitungan.</p>
                <p><strong>Teknik Pour Plate</strong>, di sisi lain, melibatkan pencampuran sejumlah volume sampel bakteri dengan media agar yang masih hangat dan cair (sekitar 45-50°C), lalu menuangkannya ke cawan petri dan membiarkannya memadat. Tujuannya adalah untuk <strong>menghitung jumlah sel bakteri hidup</strong> (<em>Viable Plate Count</em>) dalam sampel. Koloni bakteri akan tumbuh tidak hanya di permukaan agar, tetapi juga di dalam agar.</p>
            ',
            'image' => '/assets/alat/rak_tabung.png',
            'author' => 'Admin MicroLab',
            'date' => '05 September 2025'
        ],
        // Anda bisa tambahkan artikel ke-6, 7, 8, dst. di sini untuk menguji
    ];

    // Daftar artikel
    public function index()
    {
        return view('article', ['articles' => $this->articlesData]);
    }

    // Detail artikel
    public function show($id)
    {
        $article = $this->articlesData[$id] ?? null;

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan');
        }

        // Ambil semua artikel untuk sidebar, kecuali yang sedang aktif
        $otherArticles = array_filter($this->articlesData, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        // Batasi jumlah artikel di sidebar menjadi maksimal 6
        $limitedArticles = array_slice($otherArticles, 0, 6);

        return view('detailArticle', [
            'article' => $article,
            'otherArticles' => $limitedArticles // Kirim data yang sudah dibatasi
        ]);
    }
}