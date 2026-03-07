<?php

namespace App\Services;

use App\Repositories\BaseRepository;

abstract class BaseService
{
    protected BaseRepository $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(
        string|array $select = '*',
        array $where = [],
        ?string $orderBy = null,
        ?string $direction = null,
        array $joins = []
    ): mixed {
        return $this->repository->findAll($select, $where, $orderBy, $direction, $joins);
    }

    public function getById(int|string $id, string|array $select = '*'): mixed
    {
        return $this->repository->findById($id, $select);
    }

    public function create(array $data): int|string|false
    {
        return $this->repository->create($data);
    }

    public function update(int|string $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int|string $id): bool
    {
        return $this->repository->delete($id);
    }

    public function paginate(int $perPage = 20, array $where = [], string $group = 'default')
    {
        return $this->repository->paginate($perPage, $where, $group);
    }
}
