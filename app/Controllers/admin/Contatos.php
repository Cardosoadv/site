<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Services\CrmContactService;

class Contatos extends BaseController
{
    private $service;

    public function __construct()
    {
        $this->service = new CrmContactService();
    }

    public function index(): string
    {
        $data['title'] = 'Gerenciar Contatos';
        
        // Optimization: Fetch only required fields and limit results
        // This avoids loading the message (TEXT) field for the list view,
        // reducing memory usage and database transfer size.
        $data['contacts'] = $this->service->getAll(
            'crm_contacts.id, crm_contacts.name, crm_contacts.email, crm_contacts.phone, crm_contacts.status, crm_contacts.created_at, crm_areas.area_interesse as area_name',
            [],
            'crm_contacts.created_at',
            'desc',
            [['crm_areas', 'crm_contacts.area_interesse = crm_areas.id', 'left']]
        );

        return view('admin/contatos/index', $data);
    }

    public function show($id): string
    {
        $data['title'] = 'Detalhes do Contato';
        
        $contacts = $this->service->getAll(
            'crm_contacts.*, crm_areas.area_interesse as area_name',
            ['crm_contacts.id' => $id],
            null,
            null,
            [['crm_areas', 'crm_contacts.area_interesse = crm_areas.id', 'left']]
        );

        $data['contact'] = !empty($contacts) ? $contacts[0] : null;

        if (!$data['contact']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Contato não encontrado");
        }

        return view('admin/contatos/show', $data);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        
        if (!$status) {
            return redirect()->back()->with('error', 'Status inválido.');
        }

        try {
            $this->service->update($id, ['status' => $status]);
            return redirect()->to(base_url('admin/contatos'))->with('success', 'Status do contato atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->to(base_url('admin/contatos'))->with('success', 'Contato excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}