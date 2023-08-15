<?php

namespace App\Actions;

class SearchFormingAction {

    public function handle($categories) {

        if ( $categories ) {
            $result = [];
            foreach ( $categories as $category ) {
                foreach ( $category['videogames'] as $game) {
    
                // формируем ответ
                $output = [
                    'id' => $game['id'],
                    'name' => $game['name'],
                    'producer' => $game['producer']
                ];
                    $result[] = $output;
                }
            }
            return $result;
        }
        return null;
    }
}