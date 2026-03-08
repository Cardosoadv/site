<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Services\NewsService;

class Noticias extends BaseController
{

    private $service;

    public function __construct()
    {
        $this->service = new NewsService();
    }
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
        $data['title'] = 'Criar Notícia';
        $data['categories'] = $this->service->getCategories();
        return view('noticias/form', $data);
    }

    public function edit($slug): string
    {
        $data['title'] = 'Editar Notícia';
        $data['news'] = $this->service->getBySlug($slug);
        return view('admin/noticias/form');
    }

    public function store()
    {
        $data = $this->request->getPost();
        $this->service->create($data);
        return redirect()->to(base_url('admin/noticias'));
    }

    public function update($slug): string
    {
        return view('admin/noticias/update');
    }

    public function destroy($slug)
    {
        return view('admin/noticias/destroy');
    }
}
