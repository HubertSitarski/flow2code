<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 * @package App
 */
class Genre extends Model
{
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genre');
    }
}
