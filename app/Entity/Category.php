<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='bs_category';
    protected $primaryKey='id';
    
    public $timestamps = false;
}
