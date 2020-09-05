<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function listing()
    {
            return $this->belongsToMany('App\Listing');
    }
}
