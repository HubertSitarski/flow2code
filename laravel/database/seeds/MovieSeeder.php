<?php

use App\Movie;
use App\Image;
use App\Genre;
use Illuminate\Database\Seeder;

/**
 * Class MovieSeeder
 */
class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Movie::class, 20)->create()->each(function ($movie) {
            $movie->genres()->saveMany(factory(Genre::class, 2)->make());
        });
    }
}
