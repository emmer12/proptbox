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
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'profile_pic_url' => $this->profile_pic_url,
            'profile_pic_filename' => $this->profile_pic_filename,
            'listing' =>  Listing::collection($this->listing),
            'request' =>  Request::collection($this->request),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}
