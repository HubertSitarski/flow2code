<?php

namespace App\Repository\Eloquent;

use App\Movie;

/**
 * Class MovieRepository
 * @package App\Repository\Eloquent
 */
class MovieRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param Movie $movie
     */
    public function __construct(Movie $movie)
    {
        parent::__construct($movie);
    }

    /**
     * @param string $title
     * @return mixed
     */
    public function findByTitle(string $title)
    {
        return $this->model->where('title', 'like', '%' . $title . '%')->get()->first();
    }
}
