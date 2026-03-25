<?php

namespace App\Controllers;

use App\Services\NewsService;
use App\Models\NewsModel;
use App\Repositories\NewsRepository;

class Noticias extends BaseController
{
    private NewsService $service;

    public function __construct()
    {
        $this->service = service('news');
    }

    public function index(): string
    {
        $data['news'] = $this->service->getAll(
            '*',
            ['status' => 'published'],
            'published_at',
            'desc'
        );

        return view('noticias/index', $data);
    }

    public function show(string $slug): string
    {
        $news = $this->service->getBySlug($slug);

        if (!$news) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Artigo não encontrado.'
            );
        }

        $data['news']    = $news;
        $data['related'] = $this->service->getAll(
            'id, title, slug, published_at',
            ['status' => 'published'],
            'published_at',
            'desc'
        );

        // Remove o artigo atual dos relacionados
        $data['related'] = array_filter(
            $data['related'],
            fn($item) => $item['slug'] !== $slug
        );
        $data['related'] = array_slice(array_values($data['related']), 0, 3);

        return view('noticias/show', $data);
    }
}
