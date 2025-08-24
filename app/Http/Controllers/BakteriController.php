<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BakteriController extends Controller
{
    /**
     * Menampilkan halaman detail untuk bakteri spesifik.
     */
    public function show($id)
    {
        // === DATA DUMMY (SEMENTARA) ===
        // Nanti, bagian ini akan mengambil data dari database berdasarkan $id
        // Sekarang, kita buat data palsu untuk tujuan desain.
        $bakteriData = [
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
            // Tambahkan data bakteri lain di sini...
        ];

        // Ambil data bakteri yang sesuai dengan ID dari URL.
        // Jika ID tidak ditemukan, tampilkan halaman 404.
        $bakteri = $bakteriData[$id] ?? null;
        if (!$bakteri) {
            abort(404);
        }

        // Kirim data bakteri ke view 'detail-bakteri'
        return view('detail-bakteri', [
            'bakteri' => $bakteri
        ]);
    }
}