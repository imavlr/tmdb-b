<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TMDbService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.themoviedb.org/3';

    /* From: https://developer.themoviedb.org/reference/genre-movie-list
     * Should probably be populated dynamically, but the IDs are unlikely to change
     */
    const GENRES = [
        'Action' => 28,
        'Comedy' => 35,
        'Crime' => 80,
        'Documentary' => 99,
        'Drama' => 18,
        'Romance' => 10749,
        'Thriller' => 53,
        'War' => 10752,
    ];

    public function __construct()
    {
        $this->apiKey = env('TMBD_API_KEY');
    }

    /**
     * Get popular movies from TMDb by genre
     * @param string Name of the genre
     * @param page 
     */
     public function getPopularMovies($genre, $page = 1)
     {
         if (!isset(self::GENRES[$genre])) {
             return json_encode(array('error' => "Genre not found"));
         }
         
         $cacheKey = 'popular_movies_' . $genre . '_' . $page;
         $cacheTTL = 3600;

         $params['with_genres'] = self::GENRES[$genre];
         $params['page'] = $page;
         $params['sort_by'] = 'popularity.desc';

         return Cache::remember($cacheKey, $cacheTTL, function () use($params) {
             return $this->fetchFromApi('/discover/movie', $params);
         });
     }

     public function fetchFromApi($endpoint, $params = [])
     {
         $url = $this->baseUrl . $endpoint;


         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . env('TMDB_API_TOKEN')
             ])->get($url, $params);

         if ($response->successful()) {
             return $response->json();
         }
     }

     public function getMovieDetails($movieId)
     {
         $cacheKey = "movie_details_" . $movieId;
         $cacheTTL = 14400;

         $params['append_to_response'] = "credits";
         
         if (!is_numeric($movieId)) {
             return json_encode(array('error' => "Invalid movie ID"));
         }
         return Cache::remember($cacheKey, $cacheTTL, function () use($movieId, $params) {
             return $this->fetchFromApi('/movie/' . $movieId, $params);
         });
     }
}

?>
