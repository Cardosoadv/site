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

        $meta = [
            'direito-civil' => [
                'title' => 'Direito Civil | Cardoso & Bruno Sociedade de Advogados',
                'description' => 'Assessoria completa em Direito Civil: obrigações, contratos, responsabilidade civil, família e sucessões com foco em soluções eficientes.'
            ],
            'direito-administrativo' => [
                'title' => 'Direito Administrativo | Cardoso & Bruno Sociedade de Advogados',
                'description' => 'Especialistas em Direito Administrativo, licitações, contratos públicos e defesa de interesses perante a administração pública.'
            ],
            'contratos-negocios' => [
                'title' => 'Contratos e Negócios | Cardoso & Bruno Sociedade de Advogados',
                'description' => 'Elaboração, análise e revisão de contratos empresariais e civis, garantindo segurança jurídica para seus negócios e parcerias.'
            ],
            'advocacia-colaborativa' => [
                'title' => 'Advocacia Colaborativa | Cardoso & Bruno Sociedade de Advogados',
                'description' => 'Resolução de conflitos de forma consensual e humanizada. Advocacia colaborativa para divórcios, inventários e questões empresariais.'
            ],
        ];

        $data = [
            'title'           => $meta[$slug]['title'] ?? ucfirst(str_replace('-', ' ', $slug)),
            'metaDescription' => $meta[$slug]['description'] ?? '',
        ];

        return view('paginas/' . $slug, $data);
    }
}
