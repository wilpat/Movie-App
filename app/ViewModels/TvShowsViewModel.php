<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowsViewModel extends ViewModel
{
    public $shows;

    public $topRatedShows;

    public $genres;


    public function __construct($shows, $topRatedShows, $genres, $tv_genres)
    {
        $this->shows = array_slice($shows, 0, 15);
        $this->topRatedShows = array_slice($topRatedShows, 0, 15);
        $this->genres = collect($tv_genres)->merge($genres)->unique('id');
    }

    public function popularShows(){
        return $this->formatTvShows($this->shows);
    }

    public function topRatedShows(){
        return $this->formatTvShows($this->topRatedShows);
    }

    public function genres(){
        return $this->genres->mapWithKeys(function($genre, $index){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTvShows($shows){
        return collect($shows)->map(function ($show) {
            
            $formattedGenres = collect($show['genre_ids'])->mapWithKeys(function($genre_id, $index) {
                return [$index => $this->genres()->get($genre_id)];
            })->implode(', ');
            return collect($show)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'genres'=> $formattedGenres
            ]);
        });
    }
}
