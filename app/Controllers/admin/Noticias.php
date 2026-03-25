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

        $rules = [
            'title'            => 'required|max_length[255]',
            'category_id'      => 'required|integer',
            'status'           => 'required|in_list[draft,published]',
            'summary'          => 'required|max_length[500]',
            'content'          => 'required',
            'meta_title'       => 'permit_empty|max_length[255]',
            'meta_description' => 'permit_empty|max_length[160]',
            'published_at'     => 'permit_empty|valid_date[Y-m-d\TH:i]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

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

        $rules = [
            'title'            => 'required|max_length[255]',
            'category_id'      => 'required|integer',
            'status'           => 'required|in_list[draft,published]',
            'summary'          => 'required|max_length[500]',
            'content'          => 'required',
            'meta_title'       => 'permit_empty|max_length[255]',
            'meta_description' => 'permit_empty|max_length[160]',
            'published_at'     => 'permit_empty|valid_date[Y-m-d\TH:i]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

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
