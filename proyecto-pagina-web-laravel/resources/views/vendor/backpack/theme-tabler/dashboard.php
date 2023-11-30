<?php

use Backpack\CRUD\app\Library\Widget;

//Defnimos las variables donde almacenaremos la cantidad de Canales y telefonos en las variables
$phoneCount = \App\Models\Phone::count();
$infoMuniCount = \App\Models\InfoMuniCategory::count();
$infoTaxiCount = \App\Models\InfoTaxi::count();
$infoCoopCount = \App\Models\Infocoop::count();
$infoCoopArray= \App\Models\Infocoop::all();
$infoMuniArray= \App\Models\InfoMuniCategory::all();
$serviciosSocialesArray=\App\Models\SocialService::all();
$infoCoopActiveCounter=0;
$infoCoopProgrammedCounter=0;
$infoCoopExpiredCounter=0;
$infoMuniExpiredCounter=0;
$infoMuniProgrammedCounter=0;
$infoMuniActiveCounter=0;
$socialServiceCount=0;



//Conteo de canales activos de Infocoop
foreach ($infoCoopArray as $channel){
    $fechaInicio=$channel->datein;
    $fechaFinal=$channel->dateout;
    $fechaActual=now();

    if ( $fechaActual>$fechaInicio && $fechaActual<$fechaFinal) {
        $infoCoopActiveCounter++;
    }
    else{
        if($fechaActual<$fechaInicio){
            $infoCoopProgrammedCounter++;
        }
        if($fechaActual>$fechaFinal){
            $infoCoopExpiredCounter++;
        }
    }

}

//Conteo de canales activos de InfoMuni
foreach ($infoMuniArray as $channel){
    $fechaInicio=$channel->datein;
    $fechaFinal=$channel->dateout;
    $fechaActual=now();

    if ( $fechaActual>$fechaInicio && $fechaActual<$fechaFinal) {
        $infoMuniActiveCounter++;
    }
    else{
        if($fechaActual<$fechaInicio){
            $infoMuniProgrammedCounter++;
        }
        if($fechaActual>$fechaFinal){
            $infoMuniExpiredCounter++;
        }
    }
}
//Conteo de servicios sociales con respecto al burial
foreach ($serviciosSocialesArray as $servicio){
    if($servicio->burial!=null){
        $fechaBurial=$servicio->burial;
        $fechaActual=now();
    
        if ( $fechaActual<$fechaBurial) {
            $socialServiceCount++;
        }
    }

}
Widget::add(
    [
        'type'    => 'div',
        'class'   => 'row my-custom-widget-class',
        'custom-attribute'   => 'my-custom-value',
        'content' => [ // widgets

            //Widget de Infomuni
            ['type'          => 'progress_white',
            'wrapper' => ['class' => 'col-sm-6 col-md-6 mb-4'], // optional
            'class'   => 'card bg-dark text-white',
            'value'         => $infoMuniActiveCounter,
            'description'   => '<h3><b>Información Municipal </b></h3>
               Noticias programadas:'.$infoMuniProgrammedCounter.'<br>
               Noticias vencidas:'.$infoMuniExpiredCounter.'<br>
               Cantidad total de noticias:'.$infoMuniCount,
             'progress'      => $infoMuniActiveCounter/$infoMuniCount, // integer
            'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de Infocoop
            ['type'          => 'progress_white',
            'wrapper' => ['class' => 'col-sm-6 col-md-6 mb-4'], // optional
            'class'   => 'card bg-dark text-white',
                'value'         => $infoCoopActiveCounter,
                'description'   => '<h3><b>Información Cooperativa </b></h3>
               Noticias programadas:'.$infoCoopProgrammedCounter.'<br>
               Noticias vencidas:'.$infoCoopExpiredCounter.'<br>
               Cantidad total de noticias:'.$infoCoopCount,
                'progress'      => $infoCoopActiveCounter/($infoCoopCount+1), // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de Infotaxi
            ['type'          => 'progress_white',
            'wrapper' => ['class' => 'col-sm-6 col-md-6 mb-4'], // optional
            'class'   => 'card bg-dark text-white',
                'value'         => $infoTaxiCount,
                'description'   => '<h3><b>Información Remises</b></h3>',
                'progress'      => $infoTaxiCount/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],
            //Widget de social
            ['type'          => 'progress_white',
                'wrapper' => ['class' => 'col-sm-6 col-md-6'], // optional
                 'class'   => 'card bg-dark text-white', // optional
                'value'         => $socialServiceCount,
                'description'   => '<h3>Información de <b>Servicios sociales</b></h3>',
                'progress'      => $socialServiceCount/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],
            [
                'type'       => 'card',
                 'wrapper' => ['class' => 'col-sm-6 col-md-4',
                              // 'style' => 'display:flex; justify-content:center;width:100%;margin:10px;',], // optional
                               'style' => 'position: relative;
                               overflow: hidden;
                               width: 100%;
                               padding-top: 10%;',],
                               'class'   => 'card bg-dark text-white', // optional
                'content'    => [
                    'header' => '<h1 style="text-align: center">Retorno</h1>', // optional
                    //'body'   => ' <iframe src="http://127.0.0.1/index.html"  width="750" height="450"></iframe>',
                    'body'   => ' <iframe src="http://127.0.0.1/index.html" height="1200" width="100%"></iframe>',

                ]
            ],

        ]
    ]
);
?>

<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/joaquin/Desktop/Gitlab/Proyecto-Pagina-web-Laravel/proyecto-pagina-web-laravel/vendor/backpack/crud/src/resources/views/ui/dashboard.blade.php ENDPATH**/ ?>
