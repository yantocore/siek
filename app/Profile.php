<?php

namespace App;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [
        '_token'
    ];

    protected $fillable = [
        'phone', 'position', 'gender', 'avatar'
    ];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
