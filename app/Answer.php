<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';

    public function surveyresponses()
    {
        return $this->hasMany(SurveyResponse::class);
    }

}
