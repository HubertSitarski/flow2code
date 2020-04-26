<?php

namespace Tests\Feature;

use App\Constants\HttpMethods;
use App\Genre;
use App\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class AdvertisementTest
 * @package Tests\Feature
 */
class AdvertisementTest extends TestCase
{
    use RefreshDatabase;

    private static $HEADERS = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    private $uriBase = '/api/movies/';

    public function testGet()
    {
        $response = $this->buildResponse(HttpMethods::GET, $this->uriBase);

        $response
            ->assertStatus(Response::HTTP_OK);
    }

    public function testGetDetails()
    {
        $movie = factory(Movie::class)->create();

        $response = $this->buildResponse(HttpMethods::GET, $this->uriBase . $movie->title);

        $response
            ->assertStatus(Response::HTTP_OK);
    }

    public function testCreateSuccess()
    {
        $data = $this->prepareMovieData();

        factory(Genre::class, 2)->create();

        $response = $this->buildResponse(HttpMethods::POST, $this->uriBase, $data);

        $response
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function testCreateFailure()
    {
        $response = $this->buildResponse(HttpMethods::POST, $this->uriBase);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ;
    }

    public function testUpdateSuccess()
    {
        $movie = factory(Movie::class)->create();

        factory(Genre::class, 2)->create();

        $data = $this->prepareMovieData();

        $response = $this->buildResponse(HttpMethods::PUT, $this->uriBase . $movie->id, $data);

        $response
            ->assertStatus(Response::HTTP_OK);
    }

    public function testUpdateFailure()
    {
        $movie = factory(Movie::class)->create();

        $response = $this->buildResponse(HttpMethods::PUT, $this->uriBase . $movie->id);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateNotFound()
    {
        $response = $this->buildResponse(HttpMethods::PUT, $this->uriBase . 123456);

        $response
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testDeleteSuccess()
    {
        $movie = factory(Movie::class)->create();

        $response = $this->buildResponse(HttpMethods::DELETE, $this->uriBase . $movie->id);

        $response
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function testDeleteNotFound()
    {
        $response = $this->buildResponse(HttpMethods::DELETE, $this->uriBase . 420402);

        $response
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return TestResponse
     */
    private function buildResponse(string $method, string $uri, array $data = []): TestResponse
    {
        return $this->withHeaders(self::$HEADERS)->json($method, $uri, $data);
    }

    /**
     * @return array
     */
    private function prepareMovieData(): array
    {
        return [
            'title' => 'Test',
            'description' => 'Test Description',
            'image' => UploadedFile::fake()->image('photo.jpg'),
            'genres' => [0 => ['id' => 1]],
            'country' => 'Poland'
        ];
    }
}
