<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'city';

    
    /**
     * Get the suppliers in this city.
     */
    public function suppliers()
    {
        return $this->hasMany('App\Supplier');
    }

    /**
     * Get the customers in this city.
     */
    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}


