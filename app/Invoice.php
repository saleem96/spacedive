<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function task(){
        return $this->belongsTo('App\Task');
    }
    public function client_detail(){
        return $this->belongsTo('App\Client','client_id','id');
    }
}
