<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storing extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = [
        '_token',
    ];

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function city(){
        return $this->belongsTo('App\City');
    }

    public function location(){
        return $this->belongsTo('App\Location');
    }

    public function archive(){
        return $this->belongsTo('App\Archive');
    }

    public function box(){
        return $this->belongsTo('App\Box');
    }



}
