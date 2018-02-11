<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'department_name',
        'remember_token',
    ];

    protected $hidden = [
        'remember_token',
    ];



    public function storing()
    {

        return $this->hasMany('App\Storing', 'department_id');
    }

}
