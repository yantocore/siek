<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
