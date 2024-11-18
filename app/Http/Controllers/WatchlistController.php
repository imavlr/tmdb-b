<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWatchlistRequest;
use App\Http\Requests\UpdateWatchlistRequest;
use App\Models\Watchlist;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Watchlist::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWatchlistRequest $request)
    {
        $fields = $request->validate([
            'tmdb_id' => 'required',
            'title' => 'required',
            'poster_url' => 'required',
        ]);

        $watchlist = $request->user()->watchlists()->create($fields);

        return $watchlist;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watchlist $watchlist)
    {
        $watchlist->delete();

        return Watchlist::all();
    }
}
