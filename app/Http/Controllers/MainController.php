<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Videogame;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    /**
     * Показ страницы "Главная"
     */
    public function index() {
        
        return view('home');
    }

    /**
     * Показ страницы "Решение"
     */
    public function solution() {
        
        return view('solution');
    }

    /**
     * Показ страницы "CRUD"
     * @return mix
     */
    public function show( Request $request ) {

        // Данные для страницы. Для блога ПОИСК - категории, для таблицы - видеоигры
        $categories = Category::all()->pluck('id', 'name')->toArray();
        $videogames = Videogame::all();
        return view('show', compact('videogames', 'categories')); 
    }

    /**
     * Показ страницы "Добавление видеоигры"
     * @return mix
     */
    public function create() {
        return view('create')->with('categories', Category::all()->pluck('id', 'name')->toArray());
    }

    /**
     * Показ страницы "Редактирование видеоигры"
     * @return mix
     */
    public function update() {

        $url = explode("/", url()->full());
        $id = end($url);

        $game = Videogame::find($id);

        $categories = Category::all()->pluck('id', 'name')->toArray();

        // формируем данные категорий этой игры
        $checked_categories = [];
        foreach (json_decode($game->categories) as $c) {
            $checked_categories[] = $c->id;
        }

        return view('update', [
            'game' => $game, 
            'categories' => $categories, 
            'checked_categories' => $checked_categories 
        ]);
        
    }
}
