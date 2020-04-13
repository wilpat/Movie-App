@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row items-center">
            <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" alt="{{ $movie['title'] }}" class="w-64 md:w-96 item-1" >
            <div class="item-2 movie-details md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm ">
                    <svg class="fill-current text-orange-500 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18"><path d="M9 11.3l3.71 2.7-1.42-4.36L15 7h-4.55L9 2.5 7.55 7H3l3.71 2.64L5.29 14z"></path><path fill="none" d="M0 0h18v18H0z"></path></svg>
                    <span class="ml-1">{{ $movie['vote_average'] * 10 .'%'}}</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        @foreach ($movie['genres'] as $genre)
                            {{ $genre['name']}}@if (!$loop->last), @endif
                        @endforeach
                    </span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{$movie['overview']}}
                </p>

                <div class="mt-12">
                    <h4 class="font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if($loop->index == 2)
                                @break
                            @endif
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-gray-400 text-sm">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if (count($movie['videos']['results']) > 0)
                    <div x-data="{isOpen:false}">
                        <div class="mt-12">
                            <button @click="isOpen = true" class="inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150" target="_blank">
                                <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                        {{-- The Video Modal --}}
                        <div 
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            style="background: rgba(0,0,0,.5)"
                            x-show.transition.opacity="isOpen"
                            @keydown.escape.window="isOpen = false"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded" @click.away="isOpen = false">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button class="text-3xl leading-none hover:text-gray-300" @click="isOpen = false">&times;</button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe 
                                                src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" 
                                                frameborder="0"
                                                class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                allow="autoplay; encrypted-media"
                                                allowfullscreen
                                            ></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    {{-- End Movie Info --}}
    <div class="movie-cast border-b border-gray-800">

        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($movie['credits']['cast'] as $cast)
                    @if($loop->index == 5)
                        @break
                    @endif
                    <div class="mt-8">
                        <a href="#">
                            <img src="https://image.tmdb.org/t/p/w500/{{$cast['profile_path']}}" alt="{{ $cast['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
                

            </div>
        </div>
        
    </div>
    {{-- End Cast --}}

    {{-- Movie Images --}}
    <div x-data="{isOpen : false, image: ''}">
        <div class="movie-images border-b border-gray-800">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                    @foreach ($movie['images']['backdrops'] as $image)
                        @if($loop->index == 9)
                            @break
                        @endif
                        <div class="mt-8">
                            <a
                                class="cursor-pointer"
                                @click="
                                isOpen=true
                                image='https://image.tmdb.org/t/p/original/{{$image['file_path']}}'"
                            >
                                <img src="https://image.tmdb.org/t/p/w500/{{$image['file_path']}}" alt="Image {{ $loop->index }}" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div 
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
            style="background: rgba(0,0,0,.5)"
            x-show.transition.opacity="isOpen"
            @keydown.escape.window="isOpen = false"
        >
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="bg-gray-900 rounded" @click.away="isOpen = false">
                    <div class="flex justify-end pr-4 pt-2">
                        <button class="text-3xl leading-none hover:text-gray-300" @click="isOpen = false">&times;</button>
                    </div>
                    <div class="modal-body p-4">
                        <img :src="image" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection