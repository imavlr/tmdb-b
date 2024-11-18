<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $fillable = [
        'tmdb_id',
        'title',
        'poster_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
