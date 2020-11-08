<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['gender','address','dob', 'phone_number', 'school_name', 'interest', 'your_photo', 'citizenship_photo', 'marksheet_photo', 'user_id'];

    public function setInterestAttribute($value)
    {
        $this->attributes['interest'] = json_encode($value);
    }

    public function getInterestAttribute($value)
    {
        return $this->attributes['interest'] = json_decode($value);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
