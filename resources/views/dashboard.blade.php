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

    <div class="grid grid-cols-3 gap-4 mx-auto" style="width:1200px;">
        @foreach ($movies as $key => $movie)
            <div class="max-w-sm rounded overflow-hidden shadow-lg p-4 w-400">
                <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] ?? ''}}" alt="movie_poster" style="height:528px;">
                <div class="px-6 py-4 overflow-hidden" style="height:200px;">
                  <div class="font-bold text-xl mb-2">{{ $movie['title'] ?? $movie['name']}}</div>
                  <p class="text-gray-700 text-base">
                    {{ $movie['overview'] ?? ''}}
                  </p>
                </div>
                <div class="px-6 pt-4 pb-2 text-center">
                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ isset($movie['release_date']) ? substr($movie['release_date'], 0, 4) : '2017'}}</span>
                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $movie['vote_count'] ?? ''}}</span>
                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $movie['vote_average'] ?? ''}}/10</span>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
