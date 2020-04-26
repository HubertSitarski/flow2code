<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movie
 * @package App
 */
class Movie extends Model
{
    protected $fillable = ['title', 'description', 'country', 'image_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @param array $genres
     */
    public function attachGenres(array $genres)
    {
        $attachable = [];

        foreach ($genres as $genre) {
            $attachable[] = $genre['id'];
        }

        $this->genres()->attach($attachable);
    }
}
