<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class TempPhone extends Model
{
    protected $table = 'bs_temp_phone';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
