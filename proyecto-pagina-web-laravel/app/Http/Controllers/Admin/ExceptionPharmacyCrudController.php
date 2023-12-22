<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExceptionPharmacyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ExceptionPharmacyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExceptionPharmacyCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ExceptionPharmacy::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/exception-pharmacy');
        CRUD::setEntityNameStrings('Excepción Farmacias de turno', 'Excepción Farmarcias de Turno');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

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
        CRUD::setValidation(ExceptionPharmacyRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::field([
            'name'      => 'date',
            'label'     => 'Fecha',
            'type'      => 'date',
            'default'   => '2018-09-12'
        ]);

        CRUD::field([  // Select
            'label'     => "Category",
            'type'      => 'select',
            'name'      => 'idPharmacy', // the db column for the foreign key
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?


            'entity'    => 'pharmacies',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Pharmacy", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user


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
