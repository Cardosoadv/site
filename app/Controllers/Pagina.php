<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Pagina extends BaseController
{
    /**
     * @var array<string>
     */
    private array $allowedPages = [
        'direito-civil',
        'direito-administrativo',
        'contratos-negocios',
        'advocacia-colaborativa',
    ];

    /**
     * Display a specific page.
     *
     * @param string $slug
     * @return ResponseInterface|string
     */
    public function index(string $slug): ResponseInterface|string
    {
        if (!in_array($slug, $this->allowedPages, true)) {
            return redirect()->to(base_url());
        }

        $data = [
            'title' => $slug,
        ];

        return view('paginas/' . $slug, $data);
    }
}
