<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'city'          => $this->city,
            'street'        => $this->street,
            'zipcode'       => $this->zipcode,
            'url'           => $this->url,
            'image'         => new ImageResource($this->image_id),
        ];
    }
}
