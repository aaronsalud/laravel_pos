<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'province';

    /**
     * Get the suppliers in this province.
     */
    public function suppliers()
    {
        return $this->hasMany('App\Supplier');
    }

    /**
     * Get the customers in this province.
     */
    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
