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

    public function studio($id)
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


        // Ambil data bakteri yang sesuai dengan ID dari URL.
        // Jika ID tidak ditemukan, tampilkan halaman 404.
        $bakteri = $bakteriData[$id] ?? null;
        if (!$bakteri) {
            abort(404);
        }

        // Kirim data bakteri ke view 'detail-bakteri'
        return view('studio', [
            'bakteri' => $bakteri,
            'id_bakteri'=>$id
        ]);
    }


}