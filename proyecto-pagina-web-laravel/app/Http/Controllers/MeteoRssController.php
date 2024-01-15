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
            'description' => '',
            'link' => url('/'),
            'wind_dir'           => $this->convertWindDirection($this->data['modulos']['6843']['value']),
            'humidity'           => round($this->data['modulos']['6844']['value'],2).' %',
            'pressure'           => round($this->data['modulos']['6848']['value'],2).' hPa',
            'rain'               => round($this->data['modulos']['6846']['aggregations']['sum'],2).' mm',
            'dew_point'          => round($this->data['modulos']['6849']['value'],2).' °C',
            'temperature'        => round($this->data['modulos']['6853']['value'],2).' °C',
            'temperature_max'    => round($this->data['modulos']['6853']['aggregations']['max'],2).' °C',
            'temperature_min'    => round($this->data['modulos']['6853']['aggregations']['min'],2).' °C',
            'wind_speed'         => round($this->data['modulos']['6855']['value'],2).' Km/h',
            'wind_speed_max'     => round($this->data['modulos']['6855']['aggregations']['max'],2).' Km/h',
            'wind_speed_avg'     => round($this->data['modulos']['6855']['aggregations']['avg'],2).' Km/h',
            'report_time'        => $this->extractTime($this->data['date'])];

       return Response::view('MeteoServiceRss', $feedData)->header('Content-Type', 'application/rss+xml'); 
        //var_dump($feedData);
            
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

    function extractTime($inputDate)
    {
    // Split the input string into an array using ' ' (space) as the delimiter
    $parts = explode(' ', $inputDate);

    // Check if the split resulted in an array with at least two elements
    if (count($parts) < 2) {
        return 'Invalid date format';
    }

    // Extract the time part from the second element of the array
    $timePart = $parts[1];

    // Append ' hs' to the time part
    return $timePart . ' hs';
    }
    

}








