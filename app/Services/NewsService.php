<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use App\Models\NewsModel;

class NewsService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new NewsRepository(new NewsModel()));
    }

    public function getBySlug(string $slug): mixed
    {
        $result = $this->repository->findAll('*', ['slug' => $slug]);
        return !empty($result) ? $result[0] : null;
    }

    public function getCategories()
    {
        return $this->repository->getCategories();
    }
}
