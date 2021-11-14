<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function products ( ) {
        return $this -> hasMany('App\models\Product');
    }

    public function major_category( ) {
        return $this -> belongTo('App\models\MajorCategory');
    }
}