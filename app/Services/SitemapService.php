<?php

namespace App\Services;

use App\Repositories\SitemapRepository;
use App\Services\NewsService;
use CodeIgniter\Cache\CacheInterface;

class SitemapService extends BaseService
{

    protected NewsService $newsService;

    protected CacheInterface $cron; //Usando o cache para registrar tempo

    public function __construct(
        ?SitemapRepository $repository = null,
        ?NewsService $newsService = null,
        ?CacheInterface $cache = null
    ) {
        $this->newsService = $newsService ?? service('news');
        $this->cron = $cache ?? service('cache');
        parent::__construct($repository ?? new SitemapRepository());
    }

    public function getSitemapLinks(): array
    {
        $sitemap = $this->cron->get('sitemap');
        if ($sitemap !== null) {
            return $sitemap;
        }
        $this->generateSitemap();
        $sitemap = $this->repository->findAll(['url', 'last_modified', 'priority', 'changefreq']);
        $this->cron->save('sitemap', $sitemap, 24*60*60);
        return $sitemap;
    }

    public function truncateSitemap(): mixed
    {
        return $this->repository->truncate();
    }

    public function addLink(string $url, string $last_modified, string $priority, string $changefreq): mixed
    {
        $data = [
            'url'           => $url,
            'last_modified' => $last_modified,
            'priority'      => $priority,
            'changefreq'    => $changefreq,
        ];
        return $this->repository->create($data);
    }

    public function generateSitemap(): void
    {
        //Limpa a tabela
        $this->truncateSitemap();

        $links = [];
        $currentDate = date('Y-m-d');

        //Adiciona Links página Inicial
        $links[] = [
            'url'           => base_url(),
            'last_modified' => $currentDate,
            'priority'      => '1',
            'changefreq'    => 'daily',
        ];
        $links[] = [
            'url'           => base_url().'#expertise',
            'last_modified' => $currentDate,
            'priority'      => '0.8',
            'changefreq'    => 'monthly',
        ];
        $links[] = [
            'url'           => base_url().'#civil',
            'last_modified' => $currentDate,
            'priority'      => '0.8',
            'changefreq'    => 'monthly',
        ];
        $links[] = [
            'url'           => base_url().'#administrativo',
            'last_modified' => $currentDate,
            'priority'      => '0.8',
            'changefreq'    => 'monthly',
        ];
        $links[] = [
            'url'           => base_url().'#contato',
            'last_modified' => $currentDate,
            'priority'      => '0.8',
            'changefreq'    => 'monthly',
        ];

        //Adiciona Links Notícias
        $noticias = $this->newsService->getAll(['slug', 'updated_at'],['status' => 'published'], 'updated_at', 'desc');
        foreach ($noticias as $noticia) {
            $links[] = [
                'url'           => base_url().'noticias/'.$noticia['slug'],
                'last_modified' => $noticia['updated_at'],
                'priority'      => '0.8',
                'changefreq'    => 'monthly',
            ];
        }

        if (!empty($links)) {
            $this->repository->createBatch($links);
        }
    }
}
