@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row items-center">
            <img src="/img/parasite.jpg" alt="" class="w-64 md:w-96 item-1" >
            <div class="item-2 movie-details md:ml-24">
                <h2 class="text-4xl font-semibold">Parasite (2019)</h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm ">
                    <svg class="fill-current text-orange-500 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18"><path d="M9 11.3l3.71 2.7-1.42-4.36L15 7h-4.55L9 2.5 7.55 7H3l3.71 2.64L5.29 14z"></path><path fill="none" d="M0 0h18v18H0z"></path></svg>
                    <span class="ml-1">85%</span>
                    <span class="mx-2">|</span>
                    <span>Apr 08, 2020</span>
                    <span class="mx-2">|</span>
                    <span>Action, Thriller, Comedy</span>
                </div>

                <p class="text-gray-300 mt-8">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, nisi dolorem illum vero asperiores perspiciatis commodi nam reiciendis consequuntur quia iusto ducimus voluptas temporibus veritatis neque atque repellat iste aperiam tempore. Quo, non iure omnis molestiae explicabo, suscipit hic ad illo repellendus officiis expedita recusandae. Velit possimus nihil quae quibusdam.
                </p>

                <div class="mt-12">
                    <h4 class="font-semibold">Featured Cast</h4>
                    <div class="flex mt-4">
                        <div>
                            <div>Boo Joon-ho</div>
                            <div class="text-gray-400 text-sm">Director, Screenplay, Story</div>
                        </div>

                        <div class="ml-8">
                            <div>Han Jin-won</div>
                            <div class="text-gray-400 text-sm">Screenplay</div>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                        <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Movie Info --}}
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/actor1.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">Real Name</a>
                        <div class="text-gray-400 text-sm">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/actor2.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">Real Name</a>
                        <div class="text-gray-400 text-sm">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/actor3.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">Real Name</a>
                        <div class="text-gray-400 text-sm">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/actor4.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">Real Name</a>
                        <div class="text-gray-400 text-sm">
                            John Smith
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/actor5.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">Real Name</a>
                        <div class="text-gray-400 text-sm">
                            John Smith
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        
    </div>
    {{-- End Cast --}}
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/image1.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/image2.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/image3.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/image4.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/image5.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/image6.jpg" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                
            </div>
        </div>

        
    </div>
@endsection