<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';
}
