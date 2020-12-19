<div class="relative mt-3 md:mt-8">
    <input wire:model.debounce.500ms="search" type="text" name="" id="" class="bg-gray-800 rounded-full w-64 pl-8 px-4 py-1 focus:outline-none focus:shadow-outline" placeholder="search">
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if(strlen($search) > 2)
    <div class="absolute text-sm bg-gray-800 rounded w-64 mt-4">
        @if (count($searchResults) > 0)
            <ul>
                @foreach ($searchResults as $results)
                    <li class="border-b border-gray-700">
                        <a href="{{ route('movies.show', $results['id'])}}" class="box hover:bg-gray-700 px-3 py-3 flex items-center">
                            @if ($results['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{$results['poster_path']}} " alt="" class="w-8 mr-4">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="" class="w-8 mr-4">
                            @endif

                            <span>{{$results['title']}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-3 py-3">No results found for {{$search}}</div>
        @endif

    </div>
    @endif
</div>
