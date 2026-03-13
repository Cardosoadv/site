<?php

namespace App\Repositories;

use App\Models\SitemapModel;

class SitemapRepository extends BaseRepository
{


    public function __construct()
    {
        $this->model = new SitemapModel();
        parent::__construct($this->model);
    }

    public function truncate(): mixed
    {
        return $this->model->truncate();
    }
}
