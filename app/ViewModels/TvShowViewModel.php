<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
    }

    public function tvshow(){
        $formattedGenres = collect($this->tvshow['genres'])->pluck('name')->implode(', ');
        return collect($this->tvshow)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->tvshow['poster_path'],
            'vote_average' => $this->tvshow['vote_average'] * 10 .'%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => $formattedGenres,
            'crew' => collect($this->tvshow['credits']['crew'])->take(2),
            'cast' => collect($this->tvshow['credits']['cast'])->sortByDesc('profile_path')->take(5)->map(function ($cast){
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path'] ? 
                        'https://image.tmdb.org/t/p/w500'.$cast['profile_path'] :
                        'https://ui-avatars.com/api/?size=500x750&name='.$cast['name'],
                ]);
            }),
            'images' => collect($this->tvshow['images']['backdrops'])->take(9)
        ])->only([
            'poster_path', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'genres', 'credits', 'videos', 'images', 'crew', 'cast', 'images','created_by'
        ]);
    }
}
