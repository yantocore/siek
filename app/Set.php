<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';

}
