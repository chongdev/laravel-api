<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        return [
            "name" => $this->name,
            "email" => $this->email,
            // "picture" => "",
            // "scope" => [
            //     "test",
            //     "user"
            // ],
            // "iat" => 1645829537,
            // "exp" => 1645829552
        ];
    }
}
