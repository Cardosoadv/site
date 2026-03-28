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
        // Optimization: Fetch only required fields and limit results
        // This avoids loading LONGTEXT content field for list view, reducing memory usage.
        $data['news'] = $this->service->getAll(
            'id, title, slug, summary, published_at',
            ['status' => 'published'],
            'published_at',
            'desc',
            [],
            12
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

        // Optimization: Use the specialized service method to fetch filtered related news
        // at the database level instead of fetching all and filtering in PHP.
        $data['related'] = $this->service->getLatestPublishedExcept($slug, 3);

        return view('noticias/show', $data);
    }
}
