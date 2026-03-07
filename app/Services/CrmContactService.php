<?php

namespace App\Services;

use App\Repositories\CrmContactRepository;

class CrmContactService extends BaseService
{


    public function __construct()
    {
        $this->repository = new CrmContactRepository();
    }

    #################################################################
    #                           Contacts                            #
    #################################################################

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
