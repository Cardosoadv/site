<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Services\NewsService;

class Noticias extends BaseController
{

    protected $service;

    public function __construct()
    {
        $this->service = service('news');
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

        try {
            $this->service->createNews($data);
            return redirect()->to(base_url('admin/noticias'))->with('success', 'Notícia criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        try {
            $this->service->updateNews($id, $data);
            return redirect()->to(base_url('admin/noticias'))->with('success', 'Notícia atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->deleteNews($id);
            return redirect()->to(base_url('admin/noticias'))->with('success', 'Notícia excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
