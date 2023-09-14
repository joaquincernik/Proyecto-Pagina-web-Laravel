<?php

use Backpack\CRUD\app\Library\Widget;

//Defnimos las variables donde almacenaremos la cantidad de Canales y telefonos en las variables
$phoneCount = \App\Models\Phone::count();
$infoMuniCount = \App\Models\InfoMuniCategory::count();
$infoTaxiCount = \App\Models\InfoTaxi::count();
$infoCoopCount = \App\Models\Infocoop::count();
$infoCoopArray= \App\Models\Infocoop::all();
$infoMuniArray= \App\Models\InfoMuniCategory::all();
$infoCoopActiveCounter=0;
$infoCoopProgrammedCounter=0;
$infoCoopExpiredCounter=0;
$infoMuniExpiredCounter=0;
$infoMuniProgrammedCounter=0;
$infoMuniActiveCounter=0;


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
Widget::add(
    [
        'type'    => 'div',
        'class'   => 'row my-custom-widget-class',
        'custom-attribute'   => 'my-custom-value',
        'content' => [ // widgets

            //Widget de Infomuni
            ['type'          => 'progress_white',
            'class'         => 'card mb-2',
            'value'         => $infoMuniActiveCounter,
            'description'   => '<h3>Cantidad de noticias activas en <b>Info Municipal </b></h3>
               Noticias programadas:'.$infoMuniProgrammedCounter.'<br>
               Noticias vencidas:'.$infoMuniExpiredCounter.'<br>
               Cantidad total de noticias:'.$infoMuniCount,
             'progress'      => $infoMuniActiveCounter/$infoMuniCount, // integer
            'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de Infocoop
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoCoopActiveCounter,
                'description'   => '<h3>Cantidad de noticias activas en <b>Info Cooperativa </b></h3>
               Noticias programadas:'.$infoCoopProgrammedCounter.'<br>
               Noticias vencidas:'.$infoCoopExpiredCounter.'<br>
               Cantidad total de noticias:'.$infoCoopCount,
                'progress'      => $infoCoopActiveCounter/$infoCoopCount, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de Infotaxi
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoMuniCount,
                'description'   => '<h3>Cantidad de noticias en <b>Info Remises</b></h3>',
                'progress'      => $infoTaxiCount/100, // integer
                'progressClass' => 'progress-bar bg-primary',

            ],
            //Widget de telefonos
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $phoneCount,
                'description'   => '<h3>Cantidad de <b>telefonos</b></h3>',
                'progress'      => $phoneCount/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],
            [
                'type'       => 'card',
                 'wrapper' => ['class' => 'col-sm-6 col-md-4',
                               'style' => 'width:100%;',], // optional
                 'class'   => 'card bg-dark text-white', // optional
                'content'    => [
                    'header' => '<h1 style="text-align: center">Captura de pantalla</h1>', // optional
                    'body'   => ' <iframe src="http://181.118.186.249:9000/retorno.html" width="750" height="450"></iframe>',

                ]
            ],

        ]
    ]
);
?>

<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/joaquin/Desktop/Gitlab/Proyecto-Pagina-web-Laravel/proyecto-pagina-web-laravel/vendor/backpack/crud/src/resources/views/ui/dashboard.blade.php ENDPATH**/ ?>
