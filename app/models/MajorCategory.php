<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MajorCategory extends Model
{

  protected $table = 'major_categories';

    public function categories( ) {

      return $this -> hasMany('App\models\Category');
    }
}