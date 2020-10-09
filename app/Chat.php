<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function messages()
    {
        return $this->hasMany('App\Messages');
    }

    public function reciever()
    {
        return $this->belongsTo('App\User', 'to');
    }

      public function user()
    {
        return $this->belongsTo('App\User', 'from');
    }

    public function list()
    {
        return $this->belongsTo('App\Listing', 'on');
    }
}
