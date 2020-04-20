@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularShows as $show)
                    <x-tv-show-card :tvshow="$show"></x-tv-show-card>
                @endforeach
                
            </div>
        </div>
        {{-- End of popular tv shows --}}
        <div class="top-rated py-24  ">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRatedShows as $show)
                    <x-tv-show-card :tvshow="$show"></x-tv-show-card>
                @endforeach
            </div>
        </div>
    </div>
@endsection