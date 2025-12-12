<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
class ScholarProfileController extends Controller
{
    /**
     * Ideas for getting data from google scholars =
     * Request to admin for data gathering
     * Admin will either approve or disapprove
     * Admin will collect the data, input to database

     * @param Request $request
     * @param string $name
     * @return void
     */
    public function scrape(Request $request, string $name){

    }
}
