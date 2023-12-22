<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\ExceptionPharmacy;

class PharmacyRssController extends Controller
{
    public function generateRssFeed()
    {
        $pharmacy = Pharmacy::all();
        
        


    $data2view=array();
    $cantidad= Pharmacy::count();
    $id0=$this->CalculaDias()%$cantidad;

    for($i=0;$i<2;$i++) //Hoy, mañana y pasado
    {

    /*CALCULAMOS SI HAY EXCEPCIÓN PARA ESE DÍA*/
    if($idn=$this->checkExceptionByDate($this->GetDay($i)))
    {
            $id=$idn;
    }
    else    
    {       
            /*SI NO HAY EXCEPCIÓN CALCULAMOS EL ID NORMAL DEL ALGORITMO*/

            $id=($id0+$i)%$cantidad;

    }

    $datos=$this->selectPharmacyFieldsById($id);
    // Make the request to the selectPharmacyFieldsById function and get the JSON response
    $response = $this->selectPharmacyFieldsById($id);
    
    // Decode the JSON response into an associative array
    $pharmacyData = json_decode($response->getContent(), true);
    
    /*STRING PARA INFORMAR EL DIA*/
    $data2view[$i]["name"]=$pharmacyData['name'];
    $data2view[$i]["address"]=$pharmacyData['address'];
    $data2view[$i]["phone"]=$pharmacyData['phone'];

    $feedData = [
        'pharmacies' => $data2view,
        'title' => 'Farmacias de turno',
        'description' => 'Farmacias de turno',
        'link' => url('/'),
    ];



    }

    //var_dump($feedData);
    return Response::view('PharmacyRss', $feedData)->header('Content-Type', 'application/rss+xml');

    
    
    }
    public function  CalculaDias()
    {

            //$date1=$this->GetDay(0); //CERO ES HOY
            date_default_timezone_set('America/Argentina/Cordoba');
            if((int)date("G")<8)
            {
            $date=date("Y-m-d");
            $date1=date('Y-m-d', strtotime($date. '-1days'));
            }
            else
            $date1=date("Y-m-d");

            $date2="2021-08-20"; //INICIO DEL ALGORITMO
            $s = strtotime($date1)-strtotime($date2);
            $d = intval($s/86400);
            $s -= $d*86400;
            $h = intval($s/3600);
            $s -= $h*3600;
            $m = intval($s/60);
            $s -= $m*60;
            $dif2= $d;
            return($dif2);
    }

    public function  GetDay($offset)
    {
            date_default_timezone_set('America/Argentina/Cordoba');
            if($offset==0)
          {
                    if((int)date("G")<8)
                    {
                    $date=date("Y-m-d");
                    $date1=date('Y-m-d', strtotime($date. '-1days'));
                    return($date1);
                    }
          }

            date_default_timezone_set('America/Argentina/Cordoba');

            $date=date("Y-m-d");
            $date=date('Y-m-d', strtotime($date. '+'.$offset.'days'));
            return($date);
    }

    public function checkExceptionByDate($date)
    {
        $exception = ExceptionPharmacy::where('date', $date)->first();
        if ($exception) 
        {
            return $exception->idPharmacy;
        } 
        else 
        {
            return null;
        }
    
    }

    public function selectPharmacyFieldsById($id)
    {

        $pharmacy = Pharmacy::where('idpharmacy', $id)
                            ->select('idpharmacy', 'name', 'address', 'phone')
                            ->first();

        if ($pharmacy) {
            return response()->json($pharmacy);
        } else {
            return response()->json(['message' => 'Pharmacy not found'], 404);
        }
    }
}
