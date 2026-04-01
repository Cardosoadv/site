<?php

namespace App\Repositories;

use App\Models\NewsModel;

class NewsRepository extends BaseRepository
{

    private NewsCategoryRepository $newsCategoryRepository;

    public function __construct(NewsModel $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'news';
        $this->cacheTime = 60 * 60 * 24 * 7;
        $this->cacheEnabled = true;
        $this->newsCategoryRepository = new NewsCategoryRepository();
    }

    public function getNewsByCategory(int $categoryId, int $limit = 10)
    {
        return $this->findAll('*', ['category_id' => $categoryId], 'published_at', 'desc', [], $limit);
    }

    public function getNewsByAuthor(int $authorId, int $limit = 10)
    {
        return $this->findAll('*', ['author_id' => $authorId], 'published_at', 'desc', [], $limit);
    }

    public function getNewsByStatus(string $status, int $limit = 10)
    {
        return $this->findAll('*', ['status' => $status], 'published_at', 'desc', [], $limit);
    }

    public function getNewsByStatusAndCategory(string $status, int $categoryId, int $limit = 10)
    {
        return $this->findAll('*', ['status' => $status, 'category_id' => $categoryId], 'published_at', 'desc', [], $limit);
    }

    public function getCategories()
    {
        return $this->newsCategoryRepository->findAll();
    }

    public function getCategoryById(int $id)
    {
        return $this->newsCategoryRepository->findById($id);
    }

    public function getCategoryByName(string $name)
    {
        return $this->newsCategoryRepository->getByName($name);
    }

    public function getCategoryBySlug(string $slug)
    {
        return $this->newsCategoryRepository->getBySlug($slug);
    }

    /**
     * Find a single news article by its slug.
     */
    public function findBySlug(string $slug, string|array $select = '*', array $joins = [])
    {
        return $this->first($select, ['slug' => $slug], $joins);
    }

    /**
     * Get latest published news excluding a specific slug.
     * Optimization: Filters and limits at the database level to reduce memory usage and transfer size.
     * Leveraging the base findAll to benefit from centralized caching and builder logic.
     */
    public function getLatestPublishedExcept(string $slug, int $limit = 3)
    {
        return $this->findAll(
            'id, title, slug, published_at',
            [
                'status' => 'published',
                'slug !=' => $slug
            ],
            'published_at',
            'desc',
            [],
            $limit
        );
    }
}
