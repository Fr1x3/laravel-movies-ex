@extends('layouts.main')

@section('content')
    <div class="movies-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ 'https://image.tmdb.org/t/p/w500' .$movie['poster_path'] }}" alt="poster" class="w-64 md:w-96" >
            <div class="md:ml-24">
                <h2 class="mt-6 text-4xl font-semibold">
                    {{$movie['title']}}
                </h2>
                <div class="flex flex-wrap items-center text-gray-300">
                    <span>star</span>
                    <span class="ml-1">{{ $movie['vote_average'] * 10 .'%'}}</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')}}</span>
                    <span class="mx-2">|</span>
                    <span>
                        @foreach ($movie['genres'] as $genre)
                            {{ $genre['name'] }} @if (!$loop->last),@endif
                        @endforeach
                    </span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{ $movie['overview']}}
                </p>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">
                        Feature Cast
                    </h4>
                    <div class="flex mt-4">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 2)
                                <div class="mr-8">
                                    <div>{{$crew['name']}}</div>
                                    <div class="text-sm text-gray-400">
                                        {{$crew['known_for_department']}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div x-data="{isOpen: false}">
                        @if (count($movie['videos']['results']) > 0)
                            <div class="mt-12">
                                <button
                                @click="isOpen = true"

                                target="_blank" class="flex inline-flex items-center bg-red-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                                    <span>play trailer</span>
                            </button>
                            </div>

                        @endif
                        <div x-show="isOpen" style="background-color: rgba(0,0,0,0.5)" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                        @click="isOpen = false"
                                         class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div style="padding-top: 56.25%" class="responsive-container overflow-hidden relative">
                                            <iframe src="https://www.youtube.com/embed/{{$movie['videos']['results'][0]['key']}}"
                                            width="560"
                                            height="315"
                                            allow="autoplay: encrypted-media"
                                            allowfullscreen
                                            frameborder="0" class="responsive-iframe absolute top-0 left-0 w-full h-full"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">
                Cast
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movie['credits']['cast'] as $cast)
                    @if ($loop->index < 5)
                        <div class="mt-8">
                            <a href="#">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500' .$cast['profile_path'] }}" alt="profile" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                                <a href="#" class="text-lg mt-2 hover:text-gray-300">{{$cast['name']}}</a>

                                <div class="text-gray-400 text-sm">{{$cast['character']}}</div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
    <div class="movie-images border-b border-gray-800" x-data="{isOpen: false, image:''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">

            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movie['images']['backdrops'] as $img)
                    @if ($loop->index < 6)
                        <div class="mt-8">
                            <a
                            @click.prevent="
                                isOpen=true
                                image = '{{ 'https://image.tmdb.org/t/p/original/' .$img['file_path'] }}'
                            "
                            href="#"
                            >
                                <img src="{{ 'https://image.tmdb.org/t/p/w500' .$img['file_path'] }}" alt="profile" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div>
                    @endif
                @endforeach

            </div>

            <div x-show="isOpen" style="background-color: rgba(0,0,0,0.5)" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                            @click="isOpen = false"
                             class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
