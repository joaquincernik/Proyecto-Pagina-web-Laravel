<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExceptionPharmacy extends Model
{
    use CrudTrait;
    use HasFactory;
    use \Backpack\CRUD\app\Models\Traits\HasIdentifiableAttribute;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'exception_pharmacies';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = ['idPharmacy','date'];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    //Aqui se establece la relacion
    public function pharmacies(){
        return $this->belongsTo(\App\Models\Pharmacy::class,'idPharmacy');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
