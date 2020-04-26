<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Movie;
use App\Repository\Eloquent\MovieRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MovieController
 * @package App\Http\Controllers
 */
class MovieController extends Controller
{
    private $movieRepository;

    /**
     * MovieController constructor.
     * @param MovieRepository $movieRepository
     */
    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return MovieResource::collection($this->movieRepository->findAll());
    }

    /**
     * @param string $title
     * @return MovieResource
     */
    public function show(string $title)
    {
        return new MovieResource($this->movieRepository->findByTitle($title));
    }

    /**
     * @param Movie $movie
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Movie $movie)
    {
        $this->movieRepository->delete($movie->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
