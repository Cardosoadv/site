<?php

namespace App\Services;

use App\Repositories\SitemapRepository;
use App\Services\NewsService;
use CodeIgniter\Cache\CacheInterface;

class SitemapService extends BaseService
{

    protected NewsService $newsService;

    protected CacheInterface $cron; //Usando o cache para registrar tempo
    public function __construct()
    {
        $this->repository = new SitemapRepository();
        $this->newsService = new NewsService();
        $this->cron = service('cache');
        parent::__construct($this->repository);
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

        //Adiciona Links página Inicial
        $this->addLink(base_url(), date('Y-m-d'), '1', 'daily');
        $this->addLink(base_url().'#expertise', date('Y-m-d'), '0.8', 'monthly');
        $this->addLink(base_url().'#civil', date('Y-m-d'), '0.8', 'monthly');
        $this->addLink(base_url().'#administrativo', date('Y-m-d'), '0.8', 'monthly');
        $this->addLink(base_url().'#contato', date('Y-m-d'), '0.8', 'monthly');

        //Adiciona Links Notícias
        $noticias = $this->newsService->getAll(['slug', 'updated_at'],['status' => 'published'], 'updated_at', 'desc');
        foreach ($noticias as $noticia) {
            $this->addLink(base_url().'noticias/'.$noticia['slug'], $noticia['updated_at'], '0.8', 'monthly');
        }
    }
}
