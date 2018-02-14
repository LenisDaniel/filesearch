<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'archive_identifier',
        'department_id',
        '_token',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function storing()
    {
        return $this->hasMany('App\Storing', 'archive_id');
    }
}
