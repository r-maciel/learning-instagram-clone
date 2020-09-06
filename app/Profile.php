<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    /* If the user does not have an image we'll use a default image */
    public function profileImage()
    {
    	return  '/storage/'.($this->image ? $this->image : 'profile/58DzYJZ0USf0AGwTICacyaFRqZvM6ikzSL4TX1fD.png');
    }
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
