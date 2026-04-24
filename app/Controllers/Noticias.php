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
        $data['title'] = 'Cardoso & Bruno Sociedade de Advogados | Notícias';
        $data['metaDescription'] = 'Notícias e artigos sobre Direito Civil, Administrativo e Advocacia Colaborativa. Especialistas em Direito Civil, Administrativo e Contratos. Atendimento estratégico e Advocacia Colaborativa em Belo Horizonte e Juatuba.';
        $data['metaKeywords'] = 'notícias direito civil, notícias direito administrativo, notícias advocacia colaborativa, notícias belo horizonte, notícias juatuba';

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

        $data['title'] = 'Cardoso & Bruno Sociedade de Advogados | ' . $news['title'];
        $data['metaDescription'] = $news['meta_description'] ?: 'Notícias e artigos sobre Direito Civil, Administrativo e Advocacia Colaborativa. Especialistas em Direito Civil, Administrativo e Contratos. Atendimento estratégico e Advocacia Colaborativa em Belo Horizonte e Juatuba.';
        $data['metaKeywords'] = 'notícias direito civil, notícias direito administrativo, notícias advocacia colaborativa, notícias belo horizonte, notícias juatuba';

        $data['related'] = $this->service->getLatestPublishedExcept($slug, 3);

        return view('noticias/show', $data);
    }
}
