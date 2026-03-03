<?php

namespace App\Controllers;

class Noticias extends BaseController
{
    public function index(): string
    {
        return view('noticias/index');
    }

    public function show($slug): string
    {
        return view('noticias/show');
    }
}
