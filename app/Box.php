<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'box_identifier',
        '_token',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function storing()
    {
        return $this->hasMany('App\Storing', 'box_id');
    }

}
