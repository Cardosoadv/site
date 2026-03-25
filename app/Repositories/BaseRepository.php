<?php

namespace App\Repositories;

use CodeIgniter\Model;

/**
 * Class BaseRepository
 * * Abstração de repositório para CodeIgniter 4.
 * Centraliza a lógica de acesso a dados e gerenciamento de cache.
 */
abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Cache   
     */
    protected $cache;

    /**
     * @var string Prefixo da tabela para chaves de cache
     */
    protected string $cacheKey;

    /**
     * @var int 1 semana de cache por padrão
     */
    protected int $cacheTime = 604800;

    /**
     * @var bool
     */
    protected bool $cacheEnabled = true;

    public function __construct(Model $model)
    {
        $this->model       = $model;
        $this->cache       = service('cache') ?? null;
        $this->cacheKey    = $model->table;
    }

    /**
     * Inserção em lote com limpeza automática de cache.
     */
    public function createBatch(array $data): int|false
    {
        $result = $this->model->insertBatch($data);
        if ($result) {
            $this->clearCache();
        }
        return $result;
    }

    /**
     * Busca registros com suporte a Join, Filtros e Ordenação.
     * @param string|array $select
     * @param array $where
     * @param string|null $orderBy
     * @param string|null $direction
     * @param array $joins Ex: [['table', 'cond', 'type']]
     * @return array|object|null
     */
    public function findAll(
        string|array $select    = '*',
        array $where            = [],
        ?string $orderBy        = null,
        ?string $direction      = null,
        array $joins            = []
    ): mixed {
        $params = [$select, $where, $orderBy, $direction, $joins];
        $cacheName = $this->generateKey('all', $params);

        if ($this->cacheEnabled && $this->cache !== null && ($cached = $this->cache->get($cacheName)) !== null) {
            return $cached;
        }

        $builder = $this->model->select($select);

        foreach ($joins as $join) {
            $builder->join($join[0], $join[1], $join[2] ?? 'inner');
        }

        if (!empty($where)) {
            $builder->where($where);
        }

        if ($orderBy && $direction) {
            $builder->orderBy($orderBy, $direction);
        }

        $data = $builder->findAll();

        if ($this->cacheEnabled && $this->cache !== null) {
            $this->cache->save($cacheName, $data, $this->cacheTime);
        }

        return $data;
    }

    /**
     * Busca por ID com cache.
     * * @param int|string $id
     * @param string|array $select
     * @return array|object|null
     */
    public function findById(int|string $id, string|array $select = '*'): mixed
    {
        $cacheName = $this->generateKey('id_' . $id, $select);

        if ($this->cacheEnabled && $this->cache !== null && ($cached = $this->cache->get($cacheName)) !== null) {
            return $cached;
        }

        $data = $this->model->select($select)->find($id);

        if ($this->cacheEnabled && $this->cache !== null && $data) {
            $this->cache->save($cacheName, $data, $this->cacheTime);
        }

        return $data;
    }

    /**
     * Inserção com limpeza automática de cache.
     */
    public function create(array $data): int|string|false
    {
        $result = $this->model->insert($data);
        if ($result) {
            $this->clearCache();
        }
        return $result;
    }

    /**
     * Atualização com limpeza automática de cache.
     */
    public function update(int|string $id, array $data): bool
    {
        $result = $this->model->update($id, $data);
        if ($result) {
            $this->clearCache();
        }
        return $result;
    }

    /**
     * Deleção com limpeza automática de cache.
     */
    public function delete(int|string $id): bool
    {
        $result = $this->model->delete($id);
        if ($result) {
            $this->clearCache();
        }
        return $result;
    }

    /**
     * Gera chave de cache padronizada.
     */
    protected function generateKey(string $suffix, mixed $params): string
    {
        return $this->cacheKey . '_' . $suffix . '_' . md5(serialize($params));
    }

    /**
     * Limpa o cache. 
     * Nota: Se deleteMatching não funcionar no seu driver, 
     * considere mudar para Redis ou implementar uma lógica de tags.
     */
    public function clearCache(): void
    {
        if ($this->cacheEnabled && $this->cache !== null) {
            // Tentativa de limpeza por prefixo
            $this->cache->deleteMatching($this->cacheKey . '*');
        }
    }

    /**
     * Atalho para paginação nativa do CI4, integrando com o Repository.
     */
    public function paginate(int $perPage = 20, array $where = [], string $group = 'default')
    {
        return $this->model->where($where)->paginate($perPage, $group);
    }
}
