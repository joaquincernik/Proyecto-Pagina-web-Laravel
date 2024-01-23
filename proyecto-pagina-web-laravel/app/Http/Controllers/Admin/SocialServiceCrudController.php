<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SocialServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SocialServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SocialServiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\SocialService::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/social-service');
        CRUD::setEntityNameStrings('Servicios Sociales', 'servicios sociales');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.

        //In order to not showing a column:
        CRUD::column('gender')->remove(); 
       
        CRUD::column('name')->label("Nombre")->type('text');
        CRUD::column('age')->label("Edad")->type('number');
        CRUD::column('cementery')->label("Cementerio")->type('text');
        CRUD::column('response')->label("Texto auxiliar")->type('text');
        CRUD::column('burial')->label("Sepelio")->type('date');
        CRUD::addColumn([
            'name' => 'time', // Nombre de la columna en la base de datos
            'label' => 'Horario',
            'type' => 'closure',
            'function'=> function($entry){
                if($entry->time==null){
                    return 'Horario a confirmar';
                }
                else{
                    return $entry->time;
                }
            },
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($entry->time==null) {
                        return 'badge bg-warning';
                    }
                    return 'badge bg-success';
                },
            ],
        ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SocialServiceRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.

        CRUD::field([
            'name'      => 'name',
            'label'     => 'Nombre',
            'type'      => 'text',
        ]);
    

        CRUD::field([
            'name'      => 'burial',
            'label'     => 'Sepelio',
            'type'      => 'date',
        ]);
        CRUD::field([
            'name'      => 'time',
            'label'     => 'Horario',
            'type'      => 'time',
            'hint'  => 'Ingrese el horario estipulado, si no lo tiene active el boton "Horario a confirmar"',
            
        ]);
        CRUD::field([
            'name'      => 'button',
            'label'     => 'Horario a confirmar',
            'type'      => 'switch',
        ]);

        //genero
        CRUD::field([
            'name'        => 'gender', // the name of the db column
            'label'       => 'Genero', // the input label
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label;
                0 => "Hombre",
                1 => "Mujer"
            ]]);


        CRUD::field([
            'name'      => 'age',
            'label'     => 'Edad',
            'type'      => 'number',
        ]);
    
        CRUD::field([
            'name'      => 'cementery',
            'label'     => 'Cementerio',
            'type'      => 'text',
        ]);

    
        //RESPONSE (cambiar el label por un nombre identificable
        CRUD::field([
            'name'      => 'response',
            'label'     => 'Texto Auxiliar',
            'type'      => 'text',
        ]);

     
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
