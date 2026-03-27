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
        return $this->first('*', ['name' => $name]);
    }

    /**
     * Get category by Slug with cache.
     */
    public function getBySlug(string $slug)
    {
        return $this->first('*', ['slug' => $slug]);
    }
}
