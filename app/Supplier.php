<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * Get the city record associated with the supplier.
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * Get the province_id record associated with the supplier.
     */
    public function province()
    {
        return $this->belongsTo('App\Province');
    }


}
