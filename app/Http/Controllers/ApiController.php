<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videogame;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Формируем список видеоигр
     * 
     * @return Array
     */
    public function api_games() {

        $videogames = Videogame::all();

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

    /**
     * Создание новой видеоигры
     * @param  Request  $request
     * @return JSON
     */
    public function api_create(Request $request) {

        $count = Videogame::all()->count();
        // Ограничение в количестве созданнии игр
        $limit = 20;
        
        if ( $count <= $limit) {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'producer' => 'required|max:255',
                'categories' => 'required'
            ]);

            if($validator->fails()){
                return response()->json(['errors'=>$validator->messages()]);
            }

            $videogame = Videogame::create([
                'name' => $request->name,
                'producer' => $request->producer,
            ]);
    
            if ($request->categories) {
                $videogame->categories()->attach($request->categories);
            }
    
            // формируем ответ
            $output = [
                'id' => $videogame->id,
                'name' => $videogame->name,
                'producer' => $videogame->producer
            ];
            return response()->json([
                'status'=>'success',
                'videogame' => $output, 
            ], 200);
        } else {
            return response()->json([
                'message'=>'Limit in 20 records is over.', 
            ], 200);
        }
    }

    /**
     * Редактирование видеоигры
     * @param  Request  $request
     * @return JSON
     */
    public function api_update(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'producer' => 'required|max:255',
            'categories' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->messages()]);
        }

        // Находим игру по его ИД
        $videogame = Videogame::find($request->id);

        if ( $videogame ) {
            $videogame->update( 
                [
                    'name'=> $request->name,
                    'producer'=> $request->producer,
                ]
            );

            // синхронизируем данные в pivot-таблице
            if ( $request->categories ) {
                $videogame->categories()->sync($request->categories);
            }

            // формируем ответ
            $output = [
                'id' => $request->id,
                'name' => $request->name,
                'producer' => $request->producer,
                'category_id' => $request->categories
            ];
            return response()->json(['status'=>'success','videogame' => $output ], 200);
        } else {
            return response()->json(['status'=>'failed','message'=>'Видеоигра #' . $request->id .' не найдена'], 200);
        }
    }

    /**
     * Удаление видеоигры по его ИД
     * @param  Request  $request
     * @return JSON
     */
    public function api_delete(Request $request) {

        $videogame = Videogame::find($request->id);
        if ( $videogame ) {

            // удаляем сначала из pivot-таблицы данные
            $videogame->categories()->detach($request->categories);

            // теперь удаляем и саму видеоигру
            $videogame->delete();

            return response()->json(['status'=>'success','message' => 'Videogame ' . $videogame->name . ' was deleted' ], 200);
        } else {
            return response()->json(['status'=>'failed','message'=>'Videogame #' . $request->id .' not found'], 200);
        }
    }

    /**
     * Показ результата поиска видеоигр по выбранным категориям
     * @param  Request  $request
     * @return JSON
     */
    public function api_search(Request $request) {

        $validator = Validator::make($request->all(), [
            'categories' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->messages()]);
        }
        // Сам запрос к БД
        $categories = Category::with('videogames')->whereIn('id', $request->categories)->get()->toArray();

        // Обработка результата
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
            if ( $result ) {
                return response()->json(['status'=>'success', 'videogames' => $result], 200);
            } else {
                return response()->json(['message' => 'Nothing found' ], 200);
            }
        } else {
            return response()->json(['message' => 'Videogames are not found'], 200);
        }
    }
}
