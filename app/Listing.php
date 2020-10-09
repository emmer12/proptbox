<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'space_address', 'rent','about_cohabitation', 'about_property','available_from','bedroom_type','duration','images','payer_gender','space_address','space_location','space_type','expired_at','boosted_at','boosted','rating'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
            return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function views()
    {
        return $this->hasMany('App\View');
    }
}
