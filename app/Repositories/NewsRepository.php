<?php

namespace App\Repositories;

use App\Models\NewsModel;

class NewsRepository extends BaseRepository
{

    private NewsCategoryRepository $newsCategoryRepository;

    public function __construct(NewsModel $model)
    {
        $this->model = $model;
        $this->cacheKey = 'news';
        $this->cacheTime = 60 * 60 * 24 * 7;
        $this->cacheEnabled = true;
        $this->newsCategoryRepository = new NewsCategoryRepository();
    }

    public function getNewsByCategory(int $categoryId, int $limit = 10)
    {
        return $this->findAll('*', ['category_id' => $categoryId], 'published_at', 'desc');
    }

    public function getNewsByAuthor(int $authorId, int $limit = 10)
    {
        return $this->findAll('*', ['author_id' => $authorId], 'published_at', 'desc');
    }

    public function getNewsByStatus(string $status, int $limit = 10)
    {
        return $this->findAll('*', ['status' => $status], 'published_at', 'desc');
    }

    public function getNewsByStatusAndCategory(string $status, int $categoryId, int $limit = 10)
    {
        return $this->findAll('*', ['status' => $status, 'category_id' => $categoryId], 'published_at', 'desc');
    }

    public function getCategories()
    {
        return $this->newsCategoryRepository->getAll();
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


}
