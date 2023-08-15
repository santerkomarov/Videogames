<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videogame;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

use App\Repositories\VideogameRepository;
use App\Http\Requests\VideogameRequest;
use App\Http\Requests\SearchRequest;

use App\Http\Resources\ApiResource;
use App\Actions\FormingAction;
use App\Actions\SearchFormingAction;

class ApiController extends Controller
{
    /**
     * Формируем список видеоигр
     * 
     * @return Array
     */
    public function api_games(VideogameRepository $videogameRepository, FormingAction $formingAction) {

        $videogames = $videogameRepository->findAll();
        return $formingAction->handle($videogames);
    }

    /**
     * Создание новой видеоигры
     * @param  Request  $request
     * @return JSON | ApiResource
     */
    public function api_create(VideogameRequest $request, VideogameRepository $videogameRepository) {
        
        $count = $videogameRepository->count();
        // Частное ограничение этого проекта.
        $limit = 20;
        if ( $count <= $limit) {
            $videogame = $videogameRepository->create($request);
            if ($request->categories) {
                $videogame->categories()->attach($request->categories);
            }
            return new ApiResource( $videogame);
        } else {
            return response()->json(['message'=>'Limit in 20 records is over.',], 200);
        }
    }

    /**
     * Редактирование видеоигры
     * @param  Request  $request
     * @return JSON | ApiResource
     */
    public function api_update(VideogameRequest $request, VideogameRepository $videogameRepository) {

        // Находим игру по его ИД
        $videogame = $videogameRepository->find($request->id);
        if ( $videogame ) {
            $videogame = $videogameRepository->update($request, $videogame);

            // синхронизируем данные в pivot-таблице c категориями
            if ( $request->categories ) {
                $videogame->categories()->sync($request->categories);
            }
            return new ApiResource(  $videogame );
        } else {
            return response()->json(['status'=>'failed','message'=>'Видеоигра #' . $request->id .' не найдена'], 200);
        }
    }

    /**
     * Удаление видеоигры по его ИД
     * @param  Request  $request
     * @return JSON
     */
    public function api_delete(Request $request, VideogameRepository $videogameRepository) {

        if ( $videogameRepository->delete($request) ) {
            return response()->json(['status'=>'success','message' => 'Videogame was deleted' ], 200);
        }
        return response()->json(['status'=>'failed','message'=>'Videogame #' . $request->id .' not found'], 200);
    }

    /**
     * Показ результата поиска видеоигр по выбранным категориям
     * @param  Request  $request
     * @return JSON
     */
    public function api_search(SearchRequest $request, 
                                VideogameRepository $videogameRepository, 
                                SearchFormingAction $searchFormingAction
                            ) {

        $categories = $videogameRepository->search($request);

        if ($searchFormingAction->handle($categories)) {
            return response()->json([
                'status'=>'success', 
                'videogames' => $searchFormingAction->handle($categories)
            ], 200);
        } else {
            return response()->json(['message' => 'Nothing found' ], 200);
        }
    }
}
