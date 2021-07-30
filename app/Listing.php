<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'space_address', 'rent','about_cohabitation', 'about_property','available_from','bedroom_type','duration','images','payer_gender','space_address','space_location','space_type','property_type','expired_at','boosted_at','boosted','rating'
    ];

    protected $casts = [
        'boosted'=>'boolean'
    ];

 
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
            return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * The roles that belong to the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
      /**
       * Get all of the comments for the Listing
       *
       * @return \Illuminate\Database\Eloquent\Relations\HasMany
       */
      public function images()
      {
          return $this->hasMany(ListImages::class);
      }

    public function views()
    {
        return $this->hasMany('App\View');
    }
}
