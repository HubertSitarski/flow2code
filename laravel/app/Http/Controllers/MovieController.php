<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieCreateRequest;
use App\Http\Requests\MovieUpdateRequest;
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
     * @param MovieCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(MovieCreateRequest $request)
    {
        $movie = $this->movieRepository->create($request->all());

        return response()->json($movie, Response::HTTP_CREATED);
    }

    /**
     * @param MovieUpdateRequest $request
     * @param Movie $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        $this->movieRepository->update($request->all(), $movie->id);

        return response()->json($this->movieRepository->find($movie->id), Response::HTTP_OK);
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
