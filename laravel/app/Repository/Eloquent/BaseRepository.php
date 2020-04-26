<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class BaseRepository
 * @package App\Repository\Eloquent
 */
class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        $record = $this->find($id);

        return $record->update($attributes);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }
}