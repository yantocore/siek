<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function surveyresponses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
