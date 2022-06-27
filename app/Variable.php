<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

}
