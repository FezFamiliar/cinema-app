<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        
        $movies = $this->getMovies();
        $movies = json_decode($movies, true);
        // echo '<pre>';
        // print_r( $movies['results']);
        // echo '</pre>';
        // die();
        return view('dashboard', ['movies' => $movies['results']]);
    }

    public function movie() {
        
        return view('movie');
    }

    public function getMovies() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.themoviedb.org/3/trending/all/day?api_key=' . $_ENV['MOVIE_DB_API_KEY'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;
    }
}
