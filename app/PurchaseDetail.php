<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_details';

	public function purchase(){
   		return $this->belongsTo('App\Purchase');
   	}
}
