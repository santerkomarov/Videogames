<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GamesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $output = [];
        foreach ( $this->videogames as $game ) {
            // формируем данные видеоигры
            $game_data = [
                'id' => $game->id,
                'name' => $game->name
            ];

            // формируем данные категорий этой игры
            $categories = [];
            foreach (json_decode($game->categories) as $c) {
                $categories[] = [
                    'id' => $c->id,
                    'name' => $c->name
                ];
            }

            $category_data = [
                'categories' => $categories
            ];

            $output[] = [$game_data, $category_data];
        }
        return [$output];
    }
}
