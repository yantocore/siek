<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $primaryKey = 'id';

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function surveyresponses()
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
