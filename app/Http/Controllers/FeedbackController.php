<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    // Daftar artikel
    public function index()
    {
        return view('feedback');
    }
}