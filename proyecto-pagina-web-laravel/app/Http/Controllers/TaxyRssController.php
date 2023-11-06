<?php

namespace App\Http\Controllers;

use App\Models\InfoTaxi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TaxyRssController extends Controller
{
    public function generateRssFeed()
    {
        $Taxy =  $this->selectTaxy();
        $Taxy_decoded = json_decode($Taxy->getContent(), true);



        $feedData = [
            'Taxy' => $Taxy_decoded,
            'title' => 'Taxy RSS Feed',
            'description' => 'Latest Remises',
            'link' => url('/'),
        ];

        return Response::view('TaxyRss', $feedData)->header('Content-Type', 'application/rss+xml');

    }

    public function selectTaxy()
    {
        // Get the current timestamp with microseconds precision in the same format as your database
        $now = now();
        // Perform the comparison in your query
        $Taxy = InfoTaxi::where('datein', '<', $now)
        ->where('dateout', '>', $now)
        ->pluck('image');
        return(response()->json($Taxy));

    }
}
