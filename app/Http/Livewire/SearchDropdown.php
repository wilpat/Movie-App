<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';

    public $searchResults = [];
    public function render()
    {
        if(strlen($this->search) > 1){
            $this->searchResults = array_slice(Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
                ->json()['results'],0, 7);
        }
        // dump($this->searchResults);
        return view('livewire.search-dropdown');
    }
}
