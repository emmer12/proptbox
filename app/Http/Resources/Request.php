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
            'requests_description' => $this->requests_description,
            'slug' => $this->slug,
            'requests_location' => $this->requests_location,
            'requests_type' => $this->requests_type,
            'user' => User::find($this->user_id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}
