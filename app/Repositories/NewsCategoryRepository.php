<?php

namespace App\Repositories;

use App\Models\NewsCategoryModel;

class NewsCategoryRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new NewsCategoryModel());
        $this->cacheKey = 'news_categories';
        $this->cacheTime = 60 * 60 * 24 * 7;
        $this->cacheEnabled = true;
    }

    /**
     * Get all categories.
     */
    public function getAll()
    {
        return $this->findAll();
    }

    /**
     * Get category by Name with cache.
     */
    public function getByName(string $name)
    {
        $cacheName = $this->generateKey('name_' . $name, $name);

        if ($this->cacheEnabled && $this->cache !== null && ($cached = $this->cache->get($cacheName)) !== null) {
            return $cached;
        }

        $data = $this->model->where('name', $name)->first();

        if ($this->cacheEnabled && $this->cache !== null && $data) {
            $this->cache->save($cacheName, $data, $this->cacheTime);
        }

        return $data;
    }

    /**
     * Get category by Slug with cache.
     */
    public function getBySlug(string $slug)
    {
        $cacheName = $this->generateKey('slug_' . $slug, $slug);

        if ($this->cacheEnabled && $this->cache !== null && ($cached = $this->cache->get($cacheName)) !== null) {
            return $cached;
        }

        $data = $this->model->where('slug', $slug)->first();

        if ($this->cacheEnabled && $this->cache !== null && $data) {
            $this->cache->save($cacheName, $data, $this->cacheTime);
        }

        return $data;
    }
}
