<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Services\TMDbService;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->apiResource('watchlists', WatchlistController::class)->except(['update', 'show']);

Route::get('/genre/{genreId}', function ($genreId, TMDbService $tmdbService) {
    $message = $tmdbService->getPopularMovies($genreId);
    return $message;
});

Route::get('/movies/{movieId}', function($movieId, TMDbService $tmdbService) {
    $message = $tmdbService->getMovieDetails($movieId);
    return $message;
});

