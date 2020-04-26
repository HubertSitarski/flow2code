<?php

namespace App\Repository\Eloquent;

use App\Movie;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MovieRepository
 * @package App\Repository\Eloquent
 */
class MovieRepository extends BaseRepository
{
    private $imageRepository;

    /**
     * MovieRepository constructor.
     * @param Movie $movie
     * @param ImageRepository $imageRepository
     */
    public function __construct(Movie $movie, ImageRepository $imageRepository)
    {
        parent::__construct($movie);

        $this->imageRepository = $imageRepository;
    }

    /**
     * @param string $title
     * @return mixed
     */
    public function findByTitle(string $title)
    {
        return $this->model->where('title', 'like', '%' . $title . '%')->get()->first();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $attributes = $this->proccessImage($attributes);

        $model = $this->model->create($attributes);

        $attributes['genres'] ? $model->attachGenres($attributes['genres']) : null;

        return $model;
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        $record = $this->find($id);

        $attributes = $this->proccessImage($attributes);

        return $record->update($attributes);
    }

    /**
     * @param array $attributes
     * @return array
     */
    private function proccessImage(array $attributes)
    {
        if (isset($attributes['image']) && $attributes['image']) {
            $image = $this->imageRepository->upload($attributes['image']);
            $attributes['image_id'] = $image->id;
            $attributes['image'] = '';
        }

        return $attributes;
    }
}
