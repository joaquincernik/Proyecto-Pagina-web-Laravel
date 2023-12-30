<?php

namespace App\Http\Controllers;
use DateTime; // Import the DateTime class
use App\Models\SocialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MeteoRssController extends Controller
{
    public function generateRssFeed()
    {

        $this->getData();
        $feedData = [
            'title' => 'Información Cooperativa RSS Feed',
            'description' => 'Latest phones information',
            'link' => url('/'),
            'wind_dir'           => $this->convertWindDirection($this->data['modulos']['6843']['value']),
            'humidity'           => $this->data['modulos']['6844']['value'],
            'pressure'           => $this->data['modulos']['6848']['value'],
            'rain'               => $this->data['modulos']['6846']['value'],
            'dew_point'          => $this->data['modulos']['6849']['value'],
            'temperature'        => $this->data['modulos']['6853']['value'],
            'temperature_max'    => $this->data['modulos']['6853']['aggregations']['max'],
            'temperature_min'    => $this->data['modulos']['6853']['aggregations']['min'],
            'wind_speed'         => $this->data['modulos']['6855']['value'],
            'wind_speed_max'     => $this->data['modulos']['6855']['aggregations']['max'],
            'wind_speed_avg'     => $this->data['modulos']['6855']['aggregations']['max']];

       return Response::view('MeteoServiceRss', $feedData)->header('Content-Type', 'application/rss+xml');
   
    }




public function getDataFromOmx()
{
    $token = 'a3d5e9aa1631cffadd5cfbdb9a052854f480ec94'; // Replace 'YOUR_ACCESS_TOKEN' with your actual access token

    $url = 'https://new.omixom.com/api/last_measure/a3d5e9aa1631cffadd5cfbdb9a052854f480ec94/30164/';
    
    $curl = curl_init($url);
    
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token,
    ];
    
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_TIMEOUT => 30, // Set timeout in seconds
    ]);
    
    $response = curl_exec($curl);
    
    if ($response === false) {
        // Handle cURL error
        $error = curl_error($curl);
        echo "cURL Error: " . $error;
    } else {
        $data = json_decode($response, true);
        
    }
    
    curl_close($curl);
    return($data);
}

public function getData()
{
    // Check if the variable exists in the cache
    if (Cache::has('sensor_data')) 
    {
    // Retrieve the data from the cache
    $data = Cache::get('sensor_data');
    } else 
    {
    // If the data doesn't exist in the cache, retrieve it from the original source
    $data = $this->getDataFromOmx();
    echo "Not cached";

    // Store the variable in the cache for ten minutes (600 seconds)
    Cache::put('sensor_data', $data, 600); // 10 minutes
}

    $this->data=$data;
}


function convertWindDirection($degrees) {
    $directions = [
        'Norte', 'Noreste', 'Este', 'Sureste', 'Sur', 'Suroeste', 'Oeste', 'Noroeste', 'Norte'
    ];

    // Ensure degrees are within 0-360 range
    $degrees = $degrees % 360;
    if ($degrees < 0) {
        $degrees += 360;
    }

    // Calculate the index for the direction
    $index = round($degrees / 45);

    return $directions[$index];
}



}








