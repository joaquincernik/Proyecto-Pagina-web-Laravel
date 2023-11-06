<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PhoneRssController extends Controller
{
    public function generateRssFeed()
    {
        $phones = Phone::all();

        $feedData = [
            'phones' => $phones,
            'title' => 'Phone RSS Feed',
            'description' => 'Latest phones information',
            'link' => url('/'),
        ];

        return Response::view('PhoneRss', $feedData)->header('Content-Type', 'application/rss+xml');
    }
}


