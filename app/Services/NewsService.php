<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use App\Models\NewsModel;

class NewsService extends BaseService
{
    /**
     * Constructor with dependency injection support.
     */
    public function __construct(?NewsRepository $repository = null)
    {
        parent::__construct($repository ?? new NewsRepository(new NewsModel()));
        helper('url');
    }

    public function getBySlug(string $slug): mixed
    {
        return $this->repository->findBySlug(
            $slug,
            'news.*, news_categories.name as category_name',
            [
                ['news_categories', 'news.category_id = news_categories.id', 'left']
            ]
        );
    }

    public function getCategories()
    {
        return $this->repository->getCategories();
    }

    public function createNews(array $data): int|string
    {
        helper(['url', 'security']);

        // Sanitize content to prevent XSS
        if (isset($data['content'])) {
            $data['content'] = sanitize_html($data['content']);
        }
        
        // Auto-generate slug from title if not provided or empty
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = $this->makeSlug($data['title']);
        }

        // Auto-assign author if using Shield
        if (empty($data['author_id']) && auth()->loggedIn()) {
            $data['author_id'] = auth()->id();
        }

        // Set published_at if publishing now and no date is provided
        if (isset($data['status']) && $data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $id = $this->repository->create($data);

        if (!$id) {
            throw new \Exception('Erro ao criar a notícia. Verifique os dados e tente novamente.');
        }

        return $id;
    }

    public function updateNews(int $id, array $data): bool
    {
        helper(['url', 'security']);

        // Sanitize content to prevent XSS
        if (isset($data['content'])) {
            $data['content'] = sanitize_html($data['content']);
        }

        // Update slug if title changed and slug is not manually changed
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = $this->makeSlug($data['title']);
        }

        $updated = $this->repository->update($id, $data);

        if (!$updated) {
            throw new \Exception('Erro ao atualizar a notícia.');
        }

        return $updated;
    }

    public function deleteNews(int $id): bool
    {
        $deleted = $this->repository->delete($id);

        if (!$deleted) {
            throw new \Exception('Erro ao excluir a notícia.');
        }

        return $deleted;
    }

    public function getLatestPublishedExcept(string $slug, int $limit = 3)
    {
        return $this->repository->getLatestPublishedExcept($slug, $limit);
    }

    /**
     * Gera slug URL-seguro a partir de um título,
     * transliterando acentos e caracteres especiais para ASCII.
     */
    private function makeSlug(string $title): string
    {
        // Transliterate accented chars to ASCII (e.g. "ã" -> "a", "ê" -> "e")
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $title);

        // Fallback: remove non-ASCII chars if iconv fails
        if ($ascii === false || $ascii === '') {
            $ascii = preg_replace('/[^\x00-\x7F]/u', '', $title);
        }

        return url_title($ascii, '-', true);
    }
}
