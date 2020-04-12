<div class="relative">
    <input wire:model.debounde.500ms="search" type="text" class=" text-sm bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search">
    <div class="absolute top-0">
        <svg class="fill-current text-gray-500 w-4 ml-2 mt-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
    @if(strlen($search) > 1)
        <div class="search-results absolute bg-gray-800 rounded w-64 mt-4 z-10">
            <ul>
                @if(count($searchResults) > 0)
                    @foreach ($searchResults as $movie)
                        <li class="border-b border-gray-700 flex items-center">
                            @if ($movie['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{$movie['poster_path']}}" alt="{{ $movie['title'] }} icon" class="w-10 p-1">
                            @else
                                <img src="https://png.pngtree.com/element_our/png/20181227/movie-icon-which-is-designed-for-all-application-purpose-new-png_287896.jpg" alt="{{ $movie['title'] }} icon" class="w-10 p-1">
                            @endif
                            <a href="{{ route('movie.show', $movie['id']) }}" class="block hover:bg-gray-700 p-3">{{ $movie['title'] }}</a>
                        </li>
                    @endforeach
                @else
                    <li class="border-b border-gray-700">
                        <p class="p-3 block">No results for "{{ $search }}"</p>
                    </li>
                @endif
            </ul>
        </div>
    @endif
</div>