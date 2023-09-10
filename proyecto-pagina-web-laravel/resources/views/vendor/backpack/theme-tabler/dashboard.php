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
            'value'         => $infoMuniCount,
            'description'   => '<h3>Cantidad de canales en <b>Info Municipal </b></h3>
               Noticias activas:'.$infoMuniActiveCounter.'<br>
               Noticias programadas:'.$infoMuniProgrammedCounter.'<br>
               Noticias vencidas:'.$infoMuniExpiredCounter,
             'progress'      => $infoMuniActiveCounter/$infoMuniCount, // integer
            'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de Infocoop
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoCoopCount,
                'description'   => '<h3>Cantidad de canales en <b>Info Cooperativa </b></h3>
               Noticias activas:'.$infoCoopActiveCounter.'<br>
               Noticias programadas:'.$infoCoopProgrammedCounter.'<br>
               Noticias vencidas:'.$infoCoopExpiredCounter,
                'progress'      => $infoCoopActiveCounter/$infoCoopCount, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de Infotaxi
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoMuniCount,
                'description'   => '<h3>Cantidad de canales en <b>Info Remises</b></h3>',
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

        ]
    ]
);
?>

<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/joaquin/Desktop/Gitlab/Proyecto-Pagina-web-Laravel/proyecto-pagina-web-laravel/vendor/backpack/crud/src/resources/views/ui/dashboard.blade.php ENDPATH**/ ?>
