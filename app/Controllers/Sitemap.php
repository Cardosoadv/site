<?php

namespace App\Controllers;

use App\Services\SitemapService;

class Sitemap extends BaseController
{
    protected SitemapService $sitemapService;

    public function __construct()
    {
        $this->sitemapService = new SitemapService();
    }

    public function index()
    {
        $this->sitemapService->generateSitemap();
        $sitemap = $this->sitemapService->getSitemapLinks();
        return view('sitemap', ['sitemap' => $sitemap]);
    }
}
