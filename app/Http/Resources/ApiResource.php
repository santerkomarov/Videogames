<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        foreach ($this->categories as $category) {
            $gameCategories[] = $category['id'];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'producer' => $this->producer,
            'category_id' => $gameCategories
        ];
    }
}
