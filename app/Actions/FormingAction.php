<?php

namespace App\Actions;

class FormingAction {

    public function handle($videogames) {

        $output = [];
        foreach ( $videogames as $game ) {
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
        return $output;
    }
}