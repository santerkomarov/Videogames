@extends('layout.main')
@section('content')

<div class="container mt-5">
    <h1 class="my-4">
        Редактирование видеоигры
    </h1>
    <div>
        <div class="mb-5 border rounded p-4">
            <h3> Форма редактирования видеоигры с id = {{ $game->id }}</h3>
            <p class="text-secondary small">Form data:  action:'http://apicrud/api/update',  method:POST, name="categories[]", name="name", name="producer", name="id" value="{{ $game->id }}"</p>

            <form action="/api/update" method="POST" class="w-100">
                @csrf
                <div class="d-flex gap-4 border p-3 align-items-center">
                    <h5>Категории:</h5>
                    @foreach ( $categories as $key => $value)
                        <div class="form-check form-switch">
                            <input name="categories[]" class="form-check-input" type="checkbox" role="switch" 
                            id="cat_{{ $value + 1 }}" 
                            value="{{ $value }}" 
                            @if ( in_array( $value, $checked_categories ))
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="cat_{{ $value + 1 }}">{{ $key }}</label>
                        </div>
                        @endforeach
                </div>        
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="game" class="form-label">Название видеоигры</label>
                        <input type="text" name="name" class="form-control" id="movie-name" value="{{ $game->name }}">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="producer" class="form-label">Студия разработчик</label>
                        <input type="text" name="producer" class="form-control" id="producer" value="{{ $game->producer }}">
                        <input type="text" name="id" value="{{ $game->id }}" hidden>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection
