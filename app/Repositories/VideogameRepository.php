<?php

namespace App\Repositories;

use App\Models\Videogame;
use App\Models\Category;

class VideogameRepository
{
    public function findAll()
    {
        return  Videogame::all();
    }

    public function create($request)
    {
        $videogame = Videogame::create([
            'name' => $request->name,
            'producer' => $request->producer,
        ]);
        return $videogame;
    }

    public function update($request, $videogame)
    {
        $videogame->update( 
            [
                'name'=> $request->name,
                'producer'=> $request->producer,
            ]
        );
        return $videogame;
    }

    public function delete($request)
    {
        $videogame = $this->find($request->id);
        
        // удаляем сначала из pivot-таблицы данные
        $videogame->categories()->detach($request->categories);

        // теперь удаляем и саму видеоигру
        $videogame->delete();
        return true;
    }

    public function find($id)
    {
        return Videogame::find($id);
    }

    public function search($request)
    {
        return $categories = Category::with('videogames')
                            ->whereIn('id', $request->categories)
                            ->get()
                            ->toArray();
    }

    public function count()
    {
        return  Videogame::all()->count();
    }
}
