<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    <div class="mt-8">
        <a href="{{ route('movie.show', $movie['id'])}}">
        <img src="{{$movie['poster_path']}}" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
        </a>
        <div class="mt-2">
            <a href="{{ route('movie.show', $movie['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{ Str::limit($movie['title'], 25) }}</a>
            <div class="flex items-center text-gray-400 text-sm mt-1">
                <svg class="fill-current text-orange-500 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18"><path d="M9 11.3l3.71 2.7-1.42-4.36L15 7h-4.55L9 2.5 7.55 7H3l3.71 2.64L5.29 14z"></path><path fill="none" d="M0 0h18v18H0z"></path></svg>
                <span class="ml-1">{{ $movie['vote_average']}}</span>
                <span class="mx-2">|</span>
                <span>{{ $movie['release_date'] }}</span>
            </div>
            <div class="text-gray-400 text-sm">
                {{ $movie['genres']}}
            </div>
        </div>
    </div>
</div>