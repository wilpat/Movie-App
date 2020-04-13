<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewMovieTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function the_main_page_shows_correct_info ()
    {
        // $this->withoutExceptionHandling();
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->getFakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->getFakeNowPlaying(),
            'https://api.themoviedb.org/3/genre/liat' => $this->getFakeGenre(),
        ]);
        $response = $this->get(route('movies.index'));

        $response->assertStatus(200);
        $response->assertSee('Popular Movies');
        $response->assertSee('Now Playing');
        $response->assertSee('Fake Popular');
        $response->assertSee('Fake Now Playing');
        $response->assertSee('Adventure, Animation, Comedy, Family');
    }

    /** @test */
    public function user_can_view_movie_info ()
    {
        // $this->withoutExceptionHandling();
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->getFakeMovie()
        ]);
        $response = $this->get(route('movie.show', 1234));

        $response->assertStatus(200);
        $response->assertSee('Featured Crew');
        $response->assertSee('Cast');
        $response->assertSee('Images');
        $response->assertSee('Ad Astra');
        $response->assertSee('Brad Pitt');
        $response->assertSee('McBride');
    }

    /** @test */
    public function user_can_search_for_movies ()
    {
        // $this->withoutExceptionHandling();
        Http::fake([
            'https://api.themoviedb.org/3/search/movie/?query=Ad Astra' => $this->getFakeMovie()
        ]);
        Livewire::test('search-dropdown')
            ->assertDontSee('Ad Astra')
            ->set('search','Ad Astra')
            ->assertSee('Ad Astra');
    }

    private function getFakePopularMovies() {
        return Http::response([
            "results" => [
                [
                    "popularity" => 113.485,
                    "vote_count" => 9016,
                    "video" => false,
                    "poster_path" => "/qa6HCwP4Z15l3hpsASz3auugEW6.jpg",
                    "id" => 920,
                    "adult" => false,
                    "backdrop_path" => "/8KeWhoMpqbzZRyHPkTtWSLWkL5L.jpg",
                    "original_language" => "en",
                    "original_title" => "Fake Popular",
                    "genre_ids" => [
                    0 => 12,
                    1 => 16,
                    2 => 35,
                    3 => 10751,
                    ],
                    "title" => "Fake Popular",
                    "vote_average" => 6.8,
                    "overview" => "Lightning McQueen, a hotshot rookie race car driven to succeed, discovers that life is about the journey, not the finish line, when he finds himself unexpectedly detoured in the sleepy Route 66 town of Radiator Springs. On route across the country to the big Piston Cup Championship in California to compete against two seasoned pros, McQueen gets to know the town's offbeat characters.",
                    "release_date" => "2006-06-08",
                ]
            ]
        ]);
    }

    private function getFakeNowPlaying() {
        return Http::response([
            "results" => [
                [
                    "popularity" => 113.485,
                    "vote_count" => 9016,
                    "video" => false,
                    "poster_path" => "/qa6HCwP4Z15l3hpsASz3auugEW6.jpg",
                    "id" => 920,
                    "adult" => false,
                    "backdrop_path" => "/8KeWhoMpqbzZRyHPkTtWSLWkL5L.jpg",
                    "original_language" => "en",
                    "original_title" => "Fake Now Playing",
                    "genre_ids" => [
                    0 => 12,
                    1 => 16,
                    2 => 35,
                    3 => 10751,
                    ],
                    "title" => "Fake Now Playing",
                    "vote_average" => 6.8,
                    "overview" => "Lightning McQueen, a hotshot rookie race car driven to succeed, discovers that life is about the journey, not the finish line, when he finds himself unexpectedly detoured in the sleepy Route 66 town of Radiator Springs. On route across the country to the big Piston Cup Championship in California to compete against two seasoned pros, McQueen gets to know the town's offbeat characters.",
                    "release_date" => "2006-06-08",
                ]
            ]
        ]);
    }

    private function getFakeGenre() {
        return Http::response([
            "genres" => [
                0 => [
                  "id" => 28,
                  "name" => "Action"
                ],
                1 => [
                  "id" => 12,
                  "name" => "Adventure"
                ],
                2 => [
                  "id" => 16,
                  "name" => "Animation"
                ],
                3 => [
                  "id" => 35,
                  "name" => "Comedy"
                ],
                4 => [
                  "id" => 80,
                  "name" => "Crime"
                ],
                5 => [
                  "id" => 99,
                  "name" => "Documentary"
                ],
                6 => [
                  "id" => 18,
                  "name" => "Drama"
                ],
                7 => [
                  "id" => 10751,
                  "name" => "Family"
                ],
                8 => [
                  "id" => 14,
                  "name" => "Fantasy"
                ],
                9 => [
                  "id" => 36,
                  "name" => "History"
                ],
                10 => [
                  "id" => 27,
                  "name" => "Horror"
                ],
                11 => [
                  "id" => 10402,
                  "name" => "Music"
                ],
                12 => [
                  "id" => 9648,
                  "name" => "Mystery"
                ],
                13 => [
                  "id" => 10749,
                  "name" => "Romance"
                ],
                14 => [
                  "id" => 878,
                  "name" => "Science Fiction"
                ],
                15 => [
                  "id" => 10770,
                  "name" => "TV Movie"
                ],
                16 => [
                  "id" => 53,
                  "name" => "Thriller"
                ],
                17 => [
                  "id" => 10752,
                  "name" => "War"
                ],
                18 => [
                  "id" => 37,
                  "name" => "Western"
                ]
            ]
        ]);
    }

    private function getFakeMovie() {
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
            "belongs_to_collection" => null,
            "budget" => 87500000,
            "genres" => [
                0 => [
                    "id" => 878,
                    "name" => "Science Fiction",
                ],
                1 => [
                        "id" => 18,
                        "name" => "Drama",
                    ]
            ],
            "homepage" => "https://www.foxmovies.com/movies/ad-astra",
            "id" => 419704,
            "imdb_id" => "tt2935510",
            "original_language" => "en",
            "original_title" => "Ad Astra",
            "overview" => "The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on pl ▶",
            "popularity" => 565.041,
            "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
            "release_date" => "2019-09-17",
            "revenue" => 127175922,
            "runtime" => 123,
            "status" => "Released",
            "tagline" => "The answers we seek are just outside our reach",
            "title" => "Ad Astra",
            "video" => false,
            "vote_average" => 5.9,
            "vote_count" => 2913,
            "credits" =>  [
                "cast" => [
                    0 =>  [
                        "cast_id" => 2,
                        "character" => "Roy McBride",
                        "credit_id" => "58ebe95d9251413ce4030cd7",
                        "gender" => 2,
                        "id" => 287,
                        "name" => "Brad Pitt",
                        "order" => 0,
                        "profile_path" => "/kU3B75TyRiCgE270EyZnHjfivoq.jpg",
                    ],
                    1 =>  [
                        "cast_id" => 4,
                        "character" => "H. Clifford McBride",
                        "credit_id" => "594d7dcdc3a36832ad02955f",
                        "gender" => 2,
                        "id" => 2176,
                        "name" => "Tommy Lee Jones",
                        "order" => 1,
                        "profile_path" => "/xr2tuMjnXD67xx3FRaooffYmRzm.jpg",
                    ],
                    2 =>  [
                        "cast_id" => 5,
                        "character" => "Hellen Lantos",
                        "credit_id" => "5991dda9c3a368230d000885",
                        "gender" => 1,
                        "id" => 17018,
                        "name" => "Ruth Negga",
                        "order" => 2,
                        "profile_path" => "/aL4nmTVtQU2uQDNdBCarTy413CZ.jpg",
                    ],
                    3 =>  [
                        "cast_id" => 9,
                        "character" => "Lieutenant General Rivas",
                        "credit_id" => "5a94d1f9c3a36812080020c2",
                        "gender" => 2,
                        "id" => 40543,
                        "name" => "John Ortiz",
                        "order" => 3,
                        "profile_path" => "/6EXZm45aPUOERq2rCrUnkz3sGoc.jpg",
                    ],
                    4 =>  [
                        "cast_id" => 44,
                        "character" => "Eve",
                        "credit_id" => "5cf8b1f20e0a2671fdccd677",
                        "gender" => 1,
                        "id" => 882,
                        "name" => "Liv Tyler",
                        "order" => 4,
                        "profile_path" => "/q8ftpMgHVbjv3tnu7JtqFOvRjEf.jpg",
                    ],
                    5 =>  [
                        "cast_id" => 6,
                        "character" => "Thomas Pruitt",
                        "credit_id" => "5991ddb6c3a368236d000786",
                        "gender" => 2,
                        "id" => 55636,
                        "name" => "Donald Sutherland",
                        "order" => 5,
                        "profile_path" => "/pvk7fjJNg9kZQTeuG6ZlfJ8t2Ze.jpg",
                    ],
                ],
                "crew" => [
                    0 =>  [
                        "credit_id" => "5a94d2699251413261001e84",
                        "department" => "Production",
                        "gender" => 2,
                        "id" => 287,
                        "job" => "Producer",
                        "name" => "Brad Pitt",
                        "profile_path" => "/kU3B75TyRiCgE270EyZnHjfivoq.jpg",
                    ],
                    1 =>  [
                        "credit_id" => "5df0839f6a34480014c762d1",
                        "department" => "Production",
                        "gender" => 2,
                        "id" => 376,
                        "job" => "Producer",
                        "name" => "Arnon Milchan",
                        "profile_path" => "/b2hBExX4NnczNAnLuTBF4kmNhZm.jpg",
                    ],
                    2 =>  [
                        "credit_id" => "5d86778b336e010029153d70",
                        "department" => "Sound",
                        "gender" => 2,
                        "id" => 2216,
                        "job" => "Sound Designer",
                        "name" => "Gary Rydstrom",
                        "profile_path" => null,
                    ],
                ],
            ],
            "videos" =>  [
                "results" =>  [
                    0 =>  [
                        "id" => "5cf81bfb92514153b7b9e733",
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "key" => "P6AaSMfXHbA",
                        "name" => "Official Trailer #1",
                        "site" => "YouTube",
                        "size" => 1080,
                        "type" => "Trailer",
                    ],
                    1 =>  [
                        "id" => "5d313d7c326c1900101eba51",
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "key" => "nxi6rtBtBM0",
                        "name" => "Official Trailer #2",
                        "site" => "YouTube",
                        "size" => 2160,
                        "type" => "Trailer",
                    ],
                ],
            ],
            "images" =>  [
                "backdrops" => [
                    0 =>  [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                        "height" => 2160,
                        "iso_639_1" => null,
                        "vote_average" => 5.396,
                        "vote_count" => 12,
                        "width" => 3840,
                    ],
                    1 =>  [
                        "aspect_ratio" => 1.779359430605,
                        "file_path" => "/duengnNbJdTdjR329SmAAJO4stC.jpg",
                        "height" => 1124,
                        "iso_639_1" => null,
                        "vote_average" => 5.392,
                        "vote_count" => 8,
                        "width" => 2000,
                    ],
                    2 =>  [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/t4z8OlOEzH7J1JRFUN3rcm6XHNL.jpg",
                        "height" => 720,
                        "iso_639_1" => null,
                        "vote_average" => 5.388,
                        "vote_count" => 4,
                        "width" => 1280,
                    ],
                    3 =>  [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/AeDS2MKGFy6QcjgWbJBde0Ga6Hd.jpg",
                        "height" => 2160,
                        "iso_639_1" => null,
                        "vote_average" => 5.384,
                        "vote_count" => 2,
                        "width" => 3840,
                    ],
                    4 =>  [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/daopuCgMszXMpibP9Ycb5X0Ee8z.jpg",
                        "height" => 2160,
                        "iso_639_1" => null,
                        "vote_average" => 5.326,
                        "vote_count" => 7,
                        "width" => 3840,
                    ],
                    5 =>  [
                        "aspect_ratio" => 1.777972027972,
                        "file_path" => "/zT0qqteZ6qOPvVnFZCx0FNL9OD5.jpg",
                        "height" => 1716,
                        "iso_639_1" => null,
                        "vote_average" => 5.318,
                        "vote_count" => 3,
                        "width" => 3051,
                    ],
                    6 =>  [
                        "aspect_ratio" => 1.777972027972,
                        "file_path" => "/1GTdTO6h06KvnOzm5u8w4baHrUD.jpg",
                        "height" => 1716,
                        "iso_639_1" => null,
                        "vote_average" => 5.318,
                        "vote_count" => 3,
                        "width" => 3051,
                    ],
                    7 =>  [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/vbOoMut8n0v8CDqA5R1k9swy8NV.jpg",
                        "height" => 2160,
                        "iso_639_1" => "fr",
                        "vote_average" => 5.312,
                        "vote_count" => 1,
                        "width" => 3840,
                    ],
                    8 =>  [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/6BT2vjhg6L76O4O74dFikNqZvLA.jpg",
                        "height" => 1080,
                        "iso_639_1" => "en",
                        "vote_average" => 5.312,
                        "vote_count" => 1,
                        "width" => 1920,
                    ],
                ],
                "posters" => [
                    0 =>  [
                        "aspect_ratio" => 0.66666666666667,
                        "file_path" => "/xJUILftRf6TJxloOgrilOTJfeOn.jpg",
                        "height" => 3000,
                        "iso_639_1" => "en",
                        "vote_average" => 5.918,
                        "vote_count" => 26,
                        "width" => 2000,
                    ],
                ],
            ]
        ]);
    }
}
