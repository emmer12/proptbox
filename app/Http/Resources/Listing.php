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
        // 
        return [
            'id'=>$this->id,
        'about_cohabitation'=>$this->about_cohabitation,
        'about_property'=>$this->about_property,
        'available_form'=>$this->available_form,
        'bedroom_type'=>$this->bedroom_type,
        'rating'=>$this->rating,
        'rent'=>$this->rent,
        'slug'=>$this->slug,
        'space_address'=>$this->space_address,
        'space_type'=>$this->space_type,
            'updated_at'=>$this->updated_at,
            'created_at'=>$this->created_at,
            'user'=>User::where('id',$this->user_id)->first()
        ];
    }
}
