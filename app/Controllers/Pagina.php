<?php

namespace App\Controllers;



class Pagina extends BaseController

{
    private $allowedPages = [
        'direito-civil',
        'direito-administrativo',
        'contratos-negocios',
        'advocacia-colaborativa',
    ];

    public function index($slug)
    {
        if (!in_array($slug, $this->allowedPages)) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => $slug,
        ];
        return view('paginas/' . $slug, $data);
    }

}