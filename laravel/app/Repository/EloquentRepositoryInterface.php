<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface EqloquentRepositoryInterface
 * @package App\Repository
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model;

    /**
     * @return Collection
     */
    public function findAll(): Collection;
}
