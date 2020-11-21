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
            'min_budget' => $this->min_budget,
            'max_budget' => $this->max_budget,
            'space_location' => $this->space_location,
            'about_cohabitation' => $this->about_cohabitation,
            'space_type' => $this->space_type,
            'space_for' => $this->space_for,
            'user' => User::find($this->user_id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}



