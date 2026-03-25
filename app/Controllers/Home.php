<?php

namespace App\Controllers;

use App\Services\CrmContactService;

class Home extends BaseController
{
    protected $service;

    public function __construct()
    {
        $this->service = service('crmContact');
    }

    public function index(): string
    {
        $data['areas'] = $this->service->getAreas();

        return view('template/layout', $data);
    }

    public function receiveContact()
    {
        $data = $this->request->getPost();

        $rules = [
            'nome' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'telefone' => 'max_length[20]',
            'mensagem' => 'required',
            'area_interesse' => 'permit_empty|integer' // Alterado para permit_empty caso use texto ao em vez de ID as vezes
        ];

        // Se o valor não for numérico, ignoramos ou setamos um default (ex: 1 para Outros) na validação.
        // O BD exige 'area_interesse' como int.
        $areaInteresse = isset($data['area']) && is_numeric($data['area']) ? (int) $data['area'] : 1;
        $data['area_interesse'] = $areaInteresse;

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->service->create([
            'name' => $data['nome'],
            'email' => $data['email'],
            'phone' => $data['telefone'],
            'message' => $data['mensagem'],
            'area_interesse' => $data['area_interesse'],
            'status' => 'new'
        ]);

        return redirect()->back()->with('success', 'Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.');
    }
}
