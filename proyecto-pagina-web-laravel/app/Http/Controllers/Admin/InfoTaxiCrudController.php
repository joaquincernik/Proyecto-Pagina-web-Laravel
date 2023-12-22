<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InfoTaxiRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InfoTaxiCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InfoTaxiCrudController extends CrudController
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
        CRUD::setModel(\App\Models\InfoTaxi::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/infoTaxi');
        CRUD::setEntityNameStrings('Información de remises', 'Información de Remises');
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
        CRUD::column('image')->label("imagen")->type('image')->prefix('storage/');
        CRUD::column('datein')->label("fecha de entrada")->type('datetime');
        CRUD::column('dateout')->label("fecha de salida")->type('datetime');

        CRUD::addColumn([
            'name' => 'ACTIVO', // Nombre de la columna en la base de datos
            'label' => 'ACTIVO',
            'type' => 'closure',
            'function'=> function($entry){
                if($this->getEstado($entry->datein,$entry->dateout)){
                    return 'SI';
                }
                else{
                    return 'NO';
                }
            },
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($this->getEstado($entry->datein,$entry->dateout)) {
                        return 'badge bg-success';
                    }
                    return 'badge bg-warning';
                },
            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(InfoTaxiRequest::class);
        CRUD::field('image')->type('upload')->label('Imagen')->withFiles([
            'disk' => 'public', // the disk where file will be stored
            'path' => 'uploads/infomuni',
        ]);
        CRUD::field([
            'name'      => 'datein',
            'label'     => 'Fecha de entrada',
            'type'      => 'datetime',
        ]);
        CRUD::field([
            'name'      => 'dateout',
            'label'     => 'Fecha de salida',
            'type'      => 'datetime',
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
    public function getEstado($datein,$dateout)
    {
        // Obtén la fecha de entrada del modelo


        // Compara la fecha de entrada con la fecha actual
        $fechaActual = now();

        if ( $fechaActual>$datein && $fechaActual<$dateout) {
            return 1;
        } else {
            return 0;
        }
    }
}
