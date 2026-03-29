<?php

namespace App\Services;

use App\Repositories\CrmContactRepository;

class CrmContactService extends BaseService
{


    public function __construct(?CrmContactRepository $repository = null)
    {
        parent::__construct($repository ?? new CrmContactRepository());
    }

    #################################################################
    #                           Contacts                            #
    #################################################################

    /**
     * Override create to send email notification
     *
     * @param array $data
     * @return int|string|false
     */
    public function create(array $data): int|string|false
    {
        $id = parent::create($data);

        // Se o contato foi salvo com sucesso, envia o e-mail
        if ($id) {
            $this->sendNotificationEmail($data);
        }

        return $id;
    }

    /**
     * Send email notification about new contact
     *
     * @param array $data
     * @return void
     */
    private function sendNotificationEmail(array $data)
    {
        try {
            $emailService = \Config\Services::email();
            
            // Pega configurações do email para FROM
            $config = new \Config\Email();
            $from = $config->fromEmail;
            
            // Define o destinatário. Tenta pegar do .env, se não houver, usa o e-mail padrão do $from
            $to = env('CONTACT_MAIL_TO', $from);
            
            // Pega o título da área se houver area_interesse
            $areaTitle = '';
            if (!empty($data['area_interesse'])) {
                $area = $this->getAreaById((int)$data['area_interesse']);
                if ($area) {
                    $areaTitle = is_object($area) ? ($area->title ?? '') : ($area['title'] ?? '');
                }
            }

            // Corpo do e-mail iterando numa view
            $emailHtml = view('email/contact_notification', [
                'contact' => $data,
                'areaTitle' => $areaTitle
            ]);

            $emailService->setFrom($from, 'Site Admin');
            $emailService->setTo($to);
            $emailService->setSubject('Novo Contato do Site: ' . ($data['name'] ?? ''));
            $emailService->setMessage($emailHtml);
            
            // Definido para enviar em HTML
            $emailService->setMailType('html');

            $emailService->send();

        } catch (\Exception $e) {
            log_message('error', 'Erro ao enviar notificação de contato: ' . $e->getMessage());
        }
    }

    /**
     * Summary of getContactsByArea
     * @param int $areaId
     * @return array|object|null
     */
    public function getContactsByArea(int $areaId)
    {
        return $this->repository->getContactsByArea($areaId);
    }

    #################################################################
    #                           Areas                               #
    #################################################################

    /**
     * Summary of getAreas
     * @return array|object|null
     */
    public function getAreas()
    {
        return $this->repository->getAreas();
    }

    /**
     * Summary of getAreaById
     * @param int $id
     * @return array|object|null
     */
    public function getAreaById(int $id)
    {
        return $this->repository->getAreaById($id);
    }

    /**
     * Summary of createArea
     * @param array $data
     * @return int|string|false
     */
    public function createArea(array $data)
    {
        return $this->repository->createArea($data);
    }

    /**
     * Summary of updateArea
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateArea(int $id, array $data): bool
    {
        return $this->repository->updateArea($id, $data);
    }

    /**
     * Summary of deleteArea
     * @param int $id
     * @return bool
     */
    public function deleteArea(int $id): bool
    {
        return $this->repository->deleteArea($id);
    }
}
