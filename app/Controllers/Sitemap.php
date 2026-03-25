<?php

namespace App\Controllers;

use App\Services\SitemapService;

class Sitemap extends BaseController
{
    protected SitemapService $service;

    public function __construct()
    {
        $this->service = service('sitemap');
    }

    public function index()
    {
        
        $sitemap = $this->service->getSitemapLinks();
        return view('sitemap', ['sitemap' => $sitemap]);
    }

    public function generate()
    {
        $this->service->generateSitemap();
        return redirect()->back()->with('success', 'Sitemap gerado com sucesso!');
    }
}
