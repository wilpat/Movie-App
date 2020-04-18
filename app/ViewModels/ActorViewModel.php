<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor() {
        return collect($this->actor)->merge([
            'profile_path' => $this->actor['profile_path'] ? 
                'https://image.tmdb.org/t/p/w500'.$this->actor['profile_path'] :
                'https://ui-avatars.com/api/?size=500&name='.$this->actor['name'],
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age
        ]);
    }

    public function social() {
        return collect($this->social)->merge([
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id'] : null,
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id'] : null,
        ]);
    }

    public function knownFor() {
        $movies = collect($this->credits)->get('cast');
        return collect($movies)->where('media_type', 'movie')->sortByDesc('popularity')->take(5)->map(function($movie){
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ? 
                    'https://image.tmdb.org/t/p/w185'.$movie['poster_path'] :
                    'https://ui-avatars.com/api/?size=185&name='.$this->actor['name'],
                'title' => isset($movie['title']) ? $movie['title'] : 'Undefined'
            ]);
        });
    }

    public function credits() {
        $movies = collect($this->credits)->get('cast');
        return collect($movies)
            ->map(function($movie){

                if(isset($movie['release_date'])){ // Movies have release dates
                    $releaseDate = $movie['release_date'];
                } elseif (isset($movie['first_air_date'])){ // TV Shows have air date
                    $releaseDate = $movie['first_air_date'];
                } else {
                    $releaseDate = null;
                }

                if(isset($movie['title'])){ // Movies have title
                    $title = $movie['title'];
                } elseif (isset($movie['name'])){ // TV Shows have name
                    $title = $movie['name'];
                } else {
                    $title = 'Untitled';
                }

                return collect($movie)->merge([
                    'release_date' => $releaseDate,
                    'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title' => $title,
                    'character' => isset($movie['character']) ? $movie['character'] : ''
                ]);
            })
            ->sortByDesc('release_date');
    }
}
