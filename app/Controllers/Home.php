<?php

namespace App\Controllers;

use App\Services\CrmContactService;
use App\Services\NewsService;

/**
 * Controller principal que gerencia o carregamento híbrido da SPA,
 * pré-renderizando os metadados de SEO (SSR-Lite) para crawlers de forma dinâmica.
 * @version 1.0.0
 */
class Home extends BaseController
{
    protected CrmContactService $crmContactService;
    protected NewsService $newsService;

    public function __construct()
    {
        $this->crmContactService = service('crmContact');
        $this->newsService = service('news');
    }

    /**
     * Ponto de entrada unificado para todas as páginas públicas da SPA.
     * Analisa o URI e pré-carrega os metadados de SEO corretos no HTML base.
     */
    public function index(): string
    {
        // Valores Padrão (Home Page)
        $title = 'Cardoso & Bruno Sociedade de Advogados | Excelência Jurídica';
        $metaDescription = 'Cardoso & Bruno Sociedade de Advogados: Especialistas em Direito Civil, Administrativo e Contratos. Atendimento estratégico e Advocacia Colaborativa em Belo Horizonte e Juatuba.';
        $metaKeywords = 'advogado belo horizonte, inventários, divórcios, advocacia juatuba, direito administrativo mg, consultoria jurídica civil, elaboração de contratos, advocacia colaborativa, Cardoso e Bruno Sociedade de Advogados, OAB MG';

        $uri = $this->request->getUri();
        $segments = $uri->getSegments();
        
        // 1. Rota de Notícias
        if (count($segments) >= 1 && $segments[0] === 'noticias') {
            if (count($segments) >= 2) {
                // Detalhe de Notícia: /noticias/(:segment)
                $slug = $segments[1];
                $news = $this->newsService->getBySlug($slug);
                
                if ($news && $news['status'] === 'published') {
                    $title = ($news['meta_title'] ?: $news['title']) . ' | Cardoso & Bruno';
                    $metaDescription = $news['meta_description'] ?: $news['summary'];
                }
            } else {
                // Listagem de Notícias: /noticias
                $title = 'Artigos & Atualizações Jurídicas | Cardoso & Bruno Sociedade de Advogados';
                $metaDescription = 'Notícias e artigos sobre Direito Civil, Administrativo e Advocacia Colaborativa. Análise técnica sobre as principais mudanças legislativas.';
            }
        }
        
        // 2. Rota de Páginas Estáticas: /pagina/(:segment)
        if (count($segments) >= 2 && $segments[0] === 'pagina') {
            $slug = $segments[1];
            $allowedPages = [
                'direito-civil' => [
                    'title' => 'Direito Civil | Cardoso & Bruno Sociedade de Advogados',
                    'description' => 'Assessoria completa em Direito Civil: obrigações, contratos, responsabilidade civil, família e sucessões com foco em soluções eficientes.'
                ],
                'direito-administrative' => [ // Fallback caso acesse com 'direito-administrative' ou similar
                    'title' => 'Direito Administrativo | Cardoso & Bruno Sociedade de Advogados',
                    'description' => 'Especialistas em Direito Administrativo, licitações, contratos públicos e defesa de interesses perante a administração pública.'
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
            
            if (isset($allowedPages[$slug])) {
                $title = $allowedPages[$slug]['title'];
                $metaDescription = $allowedPages[$slug]['description'];
            }
        }

        $data = [
            'title'           => $title,
            'metaDescription' => $metaDescription,
            'metaKeywords'    => $metaKeywords,
            'areas'           => $this->crmContactService->getAreas()
        ];

        return view('vue_index', $data);
    }
}
