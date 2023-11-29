<?php

namespace App\Http\Controllers;

use App\Models\Infocoop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class InfocoopRssController extends Controller
{
    public function generateRssFeed()
    {
        $InfoCoop =  $this->selectInfoCoop();
        $InfoCoop_decoded = json_decode($InfoCoop->getContent(), true);
        $feedData = [
            'InfoCoop' => $InfoCoop_decoded,
            'title' => 'Información Cooperativa RSS Feed',
            'description' => 'Latest phones information',
            'link' => url('/'),
        ];

        return Response::view('InfoCoopRss', $feedData)->header('Content-Type', 'application/rss+xml');
    }

    public function selectInfoCoop()
    {
        $now = now();

        // Perform the comparison in your query

        $infoCoop = Infocoop::where('datein', '<', now())
        ->where('dateout', '>', now())
        ->select('title', 'content', 'image')
        ->get();

      return(response()->json($infoCoop));
    }
}
