<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movieId = $request->id;

        $movie = $this->getMovie($movieId);
        return $movie;
    }

    public function getMovie($id) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.themoviedb.org/3/movie/' . $id . '?api_key=' . env('MOVIE_DB_API_KEY') . '&language=en-US',
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
