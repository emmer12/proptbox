<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResouces;
use App\User;

class Listing extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
    $user=User::where('id',$this->user_id)->first();
        return [
            'id'=>$this->id,
        'about_cohabitation'=>$this->about_cohabitation,
        'about_property'=>$this->about_property,
        'available_from'=>$this->available_from,
        'payer_gender'=>$this->payer_gender,
        'bedroom_type'=>$this->bedroom_type,
        'boosted' => $this->boosted,
        'rating'=>$this->rating,
        'duration'=>$this->duration,
        'rent'=>$this->rent,
        'space_location'=>$this->space_location,
        'slug'=>$this->slug,
        'space_address'=>$this->space_address,
        'space_for'=>$this->space_for,
        'space_type'=>$this->space_type,
        'updated_at'=>$this->updated_at,
        'created_at'=>$this->created_at,
        'images'=>json_decode($this->images),
        'user'=>$user,
        'views'=>$this->views
    ];
    }
}
