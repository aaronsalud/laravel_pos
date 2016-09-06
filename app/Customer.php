<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Get the city record associated with the customer.
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * Get the province_id record associated with the customer.
     */
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
