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
        if($fechaActual>$fechaInicio){
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
        if($fechaActual>$fechaInicio){
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
            'description'   => 'Cantidad de canales en Info Municipal',
             'progress'      => $infoMuniCount/100, // integer
            'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de Infocoop
            [ 'type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoCoopCount,
                'description'   => 'Cantidad de canales en Info Cooperativa',
                'progress'      => $infoCoopCount/100, // integer
                'progressClass' => 'progress-bar bg-primary',

            ],

            //Widget de Infotaxi
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoMuniCount,
                'description'   => 'Cantidad de canales en Info Remises',
                'progress'      => $infoTaxiCount/100, // integer
                'progressClass' => 'progress-bar bg-primary',

            ],
            //Widget de telefonos
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $phoneCount,
                'description'   => 'Cantidad de telefonos',
                'progress'      => $phoneCount/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de cantidad de canales activos en Infocooop
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoCoopActiveCounter,
                'description'   => 'Cantidad de canales activos en Info Cooperativa',
                'progress'      => $infoCoopActiveCounter/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de cantidad de canales activos en InfoMuni
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoMuniActiveCounter,
                'description'   => 'Cantidad de canales activos en Info Municipal',
                'progress'      => $infoMuniActiveCounter/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de canales vencidos en infoocopp
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoCoopExpiredCounter,
                'description'   => 'Cantidad de canales vencidos en Info Cooperativa',
                'progress'      => $infoCoopExpiredCounter/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de canales vencidos en INfomuni
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoMuniExpiredCounter,
                'description'   => 'Cantidad de canales vencidos en Info Municipal',
                'progress'      => $infoMuniExpiredCounter/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de canales programados en Infocop
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoCoopProgrammedCounter,
                'description'   => 'Cantidad de canales programados en Info Cooperativa',
                'progress'      => $infoCoopProgrammedCounter/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],

            //Widget de canales programados en Infomuni
            ['type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => $infoMuniProgrammedCounter,
                'description'   => 'Cantidad de canales programados en Info Municipal',
                'progress'      => $infoMuniProgrammedCounter/100, // integer
                'progressClass' => 'progress-bar bg-primary',
            ],
        ]
    ]
);
?>

<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/joaquin/Desktop/Gitlab/Proyecto-Pagina-web-Laravel/proyecto-pagina-web-laravel/vendor/backpack/crud/src/resources/views/ui/dashboard.blade.php ENDPATH**/ ?>
