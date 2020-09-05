<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class Request extends JsonResource
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
            'requests_title' => $this->requests_title,
            'about_property' => $this->about_property,
            'budget' => $this->budget,
            'space_location' => $this->space_location,
            'space_type' => $this->space_type,
            'user' => User::find($this->user_id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}



