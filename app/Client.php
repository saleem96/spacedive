<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;



    public function tasks()
        {

      return $this->hasMany('App\Task');

        }
}

