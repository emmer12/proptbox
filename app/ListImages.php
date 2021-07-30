<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListImages extends Model
{
    protected $fillable = [
        'listing_id','filename'
    ];

    
}
