<?php

namespace App\Controllers;

use App\Services\CrmContactService;
use App\Services\NewsService;
use CodeIgniter\API\ResponseTrait;

/**
 * Controller fornecendo a API REST para a área pública em Vue.js.
 * @version 1.0.0
 */
class ApiController extends BaseController
{
    use ResponseTrait;

    protected NewsService $newsService;
    protected CrmContactService $crmContactService;

    public function __construct()
    {
        $this->newsService = service('news');
        $this->crmContactService = service('crmContact');
    }

    /**
     * Retorna a lista de áreas de interesse do CRM.
     */
    public function areas()
    {
        $areas = $this->crmContactService->getAreas();
        return $this->respond($areas);
    }

    /**
     * Retorna a lista de notícias publicadas com paginação e busca.
     */
    public function noticias()
    {
        $search = $this->request->getGet('search') ?? '';
        $page = (int) ($this->request->getGet('page') ?? 1);
        $limit = (int) ($this->request->getGet('limit') ?? 12);
        
        $newsModel = new \App\Models\NewsModel();
        
        $builder = $newsModel->where('status', 'published');
        
        if (!empty($search)) {
            $builder->groupStart()
                    ->like('title', $search)
                    ->orLike('summary', $search)
                    ->orLike('content', $search)
                    ->groupEnd();
        }
        
        // Obter total antes de aplicar limit e offset
        $total = $builder->countAllResults(false);
        
        // Paginação
        $offset = ($page - 1) * $limit;
        $data = $builder->orderBy('published_at', 'desc')
                        ->limit($limit, $offset)
                        ->findAll();
                        
        return $this->respond([
            'data' => $data,
            'total' => $total,
            'per_page' => $limit,
            'current_page' => $page,
            'last_page' => (int) ceil($total / $limit)
        ]);
    }

    /**
     * Retorna uma notícia específica com seus artigos relacionados.
     */
    public function noticiaBySlug(string $slug)
    {
        $news = $this->newsService->getBySlug($slug);
        
        if (!$news || $news['status'] !== 'published') {
            return $this->failNotFound('Artigo não encontrado.');
        }
        
        $related = $this->newsService->getLatestPublishedExcept($slug, 3);
        
        return $this->respond([
            'article' => $news,
            'related' => $related
        ]);
    }

    /**
     * Processa a submissão de mensagens de contato.
     */
    public function submitContact()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();
        
        $rules = [
            'nome' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'telefone' => 'permit_empty|max_length[20]',
            'mensagem' => 'required',
            'area_interesse' => 'permit_empty|integer'
        ];
        
        // Se o valor de 'area' for numérico, define no campo correspondente
        $areaInteresse = isset($data['area']) && is_numeric($data['area']) ? (int) $data['area'] : 1;
        $data['area_interesse'] = $areaInteresse;
        
        $validation = \Config\Services::validation();
        $validation->setRules($rules);
        
        if (!$validation->run($data)) {
            return $this->failValidationErrors($validation->getErrors());
        }
        
        try {
            $id = $this->crmContactService->create([
                'name' => $data['nome'],
                'email' => $data['email'],
                'phone' => $data['telefone'] ?? null,
                'message' => $data['mensagem'],
                'area_interesse' => $data['area_interesse'],
                'status' => 'new'
            ]);
            
            if ($id) {
                return $this->respondCreated([
                    'status' => 'success',
                    'message' => 'Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.'
                ]);
            } else {
                return $this->fail('Erro ao salvar o contato. Tente novamente mais tarde.');
            }
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
