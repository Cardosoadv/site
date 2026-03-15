<?php

namespace App\Controllers;



class Pagina extends BaseController

{
    private $alowedPages = [
        'direito-civil',
        'direito-administrativo',
        'contratos-negocios',
        'advocacia-colaborativa',
    ];

    public function index($slug)
    {
        if (!in_array($slug, $this->alowedPages)) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => $slug,
        ];
        return view('paginas/' . $slug, $data);
    }

}