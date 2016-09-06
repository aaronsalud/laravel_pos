<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the items that owns the category
     * Mencari barang yang memiliki kategori
     */
    public function items(){
    	return $this->hasMany('App\Item');
    }
}
