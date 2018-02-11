<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'city_name',
        '_token',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function storing()
    {
        return $this->hasMany('App\Storing', 'cities_id');
    }
}
