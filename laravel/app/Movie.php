<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movie
 * @package App
 */
class Movie extends Model
{
    protected $fillable = ['title', 'description', 'image_id', 'country'];

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
}
