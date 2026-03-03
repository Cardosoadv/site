<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Noticias extends BaseController
{
    public function index(): string
    {
        return view('admin/noticias/index');
    }

    public function show($slug): string
    {
        return view('admin/noticias/show');
    }

    public function create(): string
    {
        return view('admin/noticias/create');
    }

    public function edit($slug): string
    {
        return view('admin/noticias/edit');
    }

    public function store(): string
    {
        return view('admin/noticias/store');
    }

    public function update($slug): string
    {
        return view('admin/noticias/update');
    }

    public function destroy($slug): string
    {
        return view('admin/noticias/destroy');
    }
}
