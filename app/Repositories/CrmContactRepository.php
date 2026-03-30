<?php

namespace App\Repositories;

use App\Models\CrmAreaModel;
use App\Models\CrmContactModel;

class CrmContactRepository extends BaseRepository
{
    protected CrmAreaModel $crmAreaModel;

    public function __construct(?CrmContactModel $model = null, ?CrmAreaModel $areaModel = null)
    {
        parent::__construct($model ?? new CrmContactModel());
        $this->crmAreaModel = $areaModel ?? new CrmAreaModel();
        $this->cacheKey = 'crm_contacts';
        $this->cacheTime = 60 * 60 * 24 * 7;
        $this->cacheEnabled = true;
    }


    /**
     * Summary of getContactsByArea
     * @param int $areaId
     * @param string|array $select
     * @param array $where
     * @param mixed $orderBy
     * @param mixed $direction
     * @param array $joins
     * @return array|object|null
     */
    public function getContactsByArea(int $areaId, string|array $select = '*', array $where = [], ?string $orderBy = null, ?string $direction = null, array $joins = [])
    {
        return $this->findAll($select, $where, $orderBy, $direction, $joins);
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
        return $this->crmAreaModel->findAll();
    }

    /**
     * Summary of getAreaById
     * @param int $id
     * @return array|object|null
     */
    public function getAreaById(int $id)
    {
        return $this->crmAreaModel->find($id);
    }

    /**
     * Summary of createArea
     * @param array $data
     * @return int|string|false
     */
    public function createArea(array $data)
    {
        return $this->crmAreaModel->insert($data);
    }

    /**
     * Summary of updateArea
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateArea(int $id, array $data): bool
    {
        return $this->crmAreaModel->update($id, $data);
    }

    /**
     * Summary of deleteArea
     * @param int $id
     * @return bool
     */
    public function deleteArea(int $id): bool
    {
        return $this->crmAreaModel->delete($id);
    }
}
