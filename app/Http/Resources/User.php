<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Listing;
use App\Http\Resources\Request;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'location' => $this->location,
            'fullname' => $this->fullname,
            'phoneNo' => $this->phoneNo,
            'email' => $this->email,
            'gender' => $this->gender,
            'bio' => $this->bio,
            'age' => $this->age,
            'profile_pic_url' => $this->profile_pic_url,
            'profile_pic_filename' => $this->profile_pic_filename,
            'listing' =>  Listing::collection($this->listing),
            'request' =>  Request::collection($this->request),
            'created_at' => $this->created_at,
            'email_verified_at' => $this->email_verified_at,
            'phone_verified_at' => $this->phone_verified_at,
            'id_verified_at' => $this->id_verified_at,
            'updated_at' => $this->updated_at,
            'verified'=> $this->verified,
            'notifications'=> $this->notifications,
            'reveal_contact'=> $this->reveal_contact,
            'isAdmin'=> $this->isAdmin

            ];
    }
}
