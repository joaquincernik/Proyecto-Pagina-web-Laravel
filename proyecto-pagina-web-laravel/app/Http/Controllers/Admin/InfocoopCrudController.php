<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InfocoopRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
/**
 * Class InfocoopCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InfocoopCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Infocoop::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/infocoop');
        CRUD::setEntityNameStrings('infoCoop', 'infoCoop');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */

    protected function setupListOperation()
    {
        CRUD::column('image')->type('image')->prefix('storage/');
        CRUD::setFromDb(); // set columns from db columns.
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
        CRUD::orderby('dateout','desc');


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
        CRUD::setValidation(InfocoopRequest::class);
   //     CRUD::setFromDb(); // set fields from db columns.

        CRUD::field('image')->type('upload')->label('Pon tu imagen')->withFiles([
            'disk' => 'public', // the disk where file will be stored
            'path' => 'uploads/infocoop',
        ]);
        CRUD::field([
            'name'      => 'title',
            'label'     => 'titulo',
            'type'      => 'text',
        ]);
        CRUD::field([
            'name'      => 'content',
            'label'     => 'contenido',
            'type'      => 'text',
        ]);
        CRUD::field([
        'name'      => 'datein',
        'label'     => 'fecha de entrada',
        'type'      => 'datetime',
    ]);
        CRUD::field([
            'name'      => 'dateout',
            'label'     => 'fecha de salida',
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


    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        CRUD::set('reorder.label', 'title');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        CRUD::set('reorder.max_level', 2);
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
