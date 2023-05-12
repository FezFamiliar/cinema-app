<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        @foreach ($movies as $key => $movie)
            
            <p>Title: {{ $movie['title'] ?? ''}}</p>
            <p>Year: {{ $movie['release_date'] ?? ''}}</p>
            <p>vote: {{ $movie['vote_count'] ?? ''}}</p>
            <p>Description: {{ $movie['overview'] ?? ''}}</p>
            <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] ?? ''}}" alt="movie_poster">
        @endforeach
    </div>
</x-app-layout>
