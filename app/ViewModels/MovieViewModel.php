<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $apiMovie;

    public function __construct($movie)
    {
        $this->apiMovie = $movie;
    }

    public function movie(){
        $formattedGenres = collect($this->apiMovie['genres'])->pluck('name')->implode(', ');
        return collect($this->apiMovie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->apiMovie['poster_path'],
            'vote_average' => $this->apiMovie['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($this->apiMovie['release_date'])->format('M d, Y'),
            'genres' => $formattedGenres,
            'crew' => collect($this->apiMovie['credits']['crew'])->take(2),
            'cast' => collect($this->apiMovie['credits']['cast'])->take(5)->sortByDesc('profile_path')->map(function ($cast){
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path'] ? 
                        'https://image.tmdb.org/t/p/w500'.$cast['profile_path'] :
                        'https://ui-avatars.com/api/?size=500x750&name='.$cast['name'],
                ]);
            }),
            'images' => collect($this->apiMovie['images']['backdrops'])->take(9)
        ])->only([
            'poster_path', 'id', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'credits', 'videos', 'images', 'crew', 'cast', 'images'
        ]);
    }
}
