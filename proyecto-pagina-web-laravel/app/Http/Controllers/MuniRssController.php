<?php

namespace App\Http\Controllers;

use App\Models\InfoMuniCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MuniRssController extends Controller
{
    public function generateRssFeed()
    {
        $Muni =  $this->selectMuni();
        $Muni_decoded = json_decode($Muni->getContent(), true);

        $feedData = [
            'InfoMuni' => $Muni,
            'title' => 'Municipalidad RSS Feed',
            'description' => 'Latest phones information',
            'link' => url('/'),
        ];

        return Response::view('MuniRss', $feedData)->header('Content-Type', 'application/rss+xml');
    }


    public function selectMuni()
    {
        $now = now();

        // Perform the comparison in your query
        $Muni = InfoMuniCategory::where('datein', '<', $now)
                         ->where('dateout', '>', $now)
                         ->pluck('image');

      return(response()->json($Muni));
    }
}
