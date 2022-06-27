<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';

    public function variable()
    {
        return $this->belongsTo(Variable::class);
    }
}
