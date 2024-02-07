<?php

namespace App\Http\Controllers;

use App\Models\SocialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SocialesRssController extends Controller
{
    public function generateRssFeed()
    {
        $Social =  $this->selectSocial();

        $Social_decoded = json_decode($Social->getContent(), true);



//var_dump($Social_decoded);
        $feedData = [
            'SocialServices' => $Social_decoded,
            'title' => 'Servicios Sociales RSS Feed',
            'description' => 'Latest phones information',
            'link' => url('/'),
        ];

       return Response::view('SocialServicesRss', $feedData)->header('Content-Type', 'application/rss+xml');
    }


    public function selectSocial()
    {
        $now = now();

	// Perform the comparison in your query
	$Social = SocialService::where('burial', '>', $now)->orWhere('button', '>',0)->get();
	//
        // Perform the comparison in your query
        //$Social = SocialService::where('burial', '>', $now)->get();

        return(response()->json($Social));


    }
}
