<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'bs_member';
    protected $primaryKey = 'id';

    //public $timestamps = false;
}
