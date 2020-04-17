<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;

    public $pageNumber;

    public function __construct($popularActors, $pageNumber)
    {
        $this->popularActors = $popularActors;
        $this->pageNumber = $pageNumber;
    }

    public function popularActors(){
        return collect($this->popularActors)->map(function ($actor) {
            
            // $formattedGenres = collect($actor['genre_ids'])->mapWithKeys(function($genre_id, $index) {
            //     return [$index => $this->genres()->get($genre_id)];
            // })->implode(', ');
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ? 
                    'https://image.tmdb.org/t/p/w470_and_h470_face/'.$actor['profile_path'] :
                    'https://ui-avatars.com/api/?size=470&name='.$actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', ')
            ])->only([
                'profile_path', 'id', 'name', 'known_for'
            ]);
        });
    }

    public function next() {
        return $this->pageNumber < 500 ? $this->pageNumber + 1 : null;
    }

    public function previous() {
        return $this->pageNumber > 1 ? $this->pageNumber - 1 : null;
    }
}
