<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Daftar artikel
    public function index()
    {
        $articles = [
            [
                'id' => 1,
                'title' => 'Escherichia coli (E. coli)',
                'excerpt' => 'Bakteri yang sering ditemukan di usus manusia, ada yang bermanfaat tapi ada juga yang berbahaya.',
                'image' => '/assets/bakteri/1.jpeg'
            ],
            [
                'id' => 2,
                'title' => 'Staphylococcus aureus',
                'excerpt' => 'Bakteri penyebab infeksi kulit, pneumonia, dan keracunan makanan.',
                'image' => '/assets/bakteri/2.jpeg'
            ],
            [
                'id' => 3,
                'title' => 'Salmonella',
                'excerpt' => 'Bakteri yang biasanya menyerang usus manusia melalui makanan atau air yang terkontaminasi.',
                'image' => '/assets/bakteri/3.jpeg'
            ],
        ];

        return view('article', compact('articles'));
    }

    // Detail artikel
    public function show($id)
    {
        $articles = [
            1 => [
                'id' => 1,
                'title' => 'Escherichia coli (E. coli)',
                'content' => '
                    <p>E. coli adalah bakteri yang hidup di usus manusia. 
                    Beberapa strain E. coli tidak berbahaya dan justru membantu pencernaan. 
                    Namun, ada strain berbahaya seperti E. coli O157:H7 yang dapat menyebabkan diare parah dan gagal ginjal.</p>
                ',
                'image' => '/assets/bakteri/1.jpeg',
                'author' => 'Admin MicroLab',
                'date' => '28 Agustus 2025'
            ],
            2 => [
                'id' => 2,
                'title' => 'Staphylococcus aureus',
                'content' => '
                    <p>Staphylococcus aureus adalah bakteri yang bisa ditemukan di kulit dan saluran pernapasan manusia. 
                    Jika masuk ke tubuh melalui luka, dapat menyebabkan infeksi serius seperti pneumonia, sepsis, hingga keracunan makanan.</p>
                ',
                'image' => '/assets/bakteri/2.jpeg',
                'author' => 'Admin MicroLab',
                'date' => '28 Agustus 2025'
            ],
            3 => [
                'id' => 3,
                'title' => 'Salmonella',
                'content' => '
                    <p>Salmonella adalah bakteri penyebab penyakit salmonellosis. 
                    Infeksi ini sering ditularkan melalui makanan yang tidak dimasak sempurna atau air yang terkontaminasi. 
                    Gejalanya meliputi diare, demam, mual, dan muntah.</p>
                ',
                'image' => '/assets/bakteri/3.jpeg',
                'author' => 'Admin MicroLab',
                'date' => '28 Agustus 2025'
            ],
        ];

        $article = $articles[$id] ?? abort(404);

        return view('detailArticle', compact('article'));
    }
}