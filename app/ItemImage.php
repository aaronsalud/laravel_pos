<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'itemImages';

	public function item(){
   		return $this->belongsTo('App\Item');
   	}
}
