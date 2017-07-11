<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'bs_order';
    protected $primaryKey = 'id';

    //public $timestamps = false;
}
