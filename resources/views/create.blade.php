@extends('layout.main')
@section('content')
<div class="container mt-5">
    <h1 class="my-4">
        Добавление видеоигры
    </h1>
    <div>
        <div class="mb-5 border rounded p-4">
            <h3>Форма добавления игры в БД </h3>
            <p class="text-secondary small">Form data:  action: 'http://apicrud/api/create',  method:POST, name="categories[]", name="game", name="producer"</p>
            <form action="/api/create" method="POST" class="w-100">
                @csrf
                <div class="border p-2">
                    <div class="d-flex gap-4">
                        <h5>Выберите категорию игры: </h5>
                        @foreach ( $categories as $key => $value)
                        <div class="form-check form-switch">
                            <input name="categories[]" class="form-check-input" type="checkbox" role="switch" id="cat_{{ $value + 1 }}" value="{{ $value }}" >
                            <label class="form-check-label" for="cat_{{ $value + 1 }}">{{ $key }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="game" class="form-label">Название видеоигры</label>
                        <input type="text" value="{{ old('game')}}" name="name" class="form-control" id="movie-name" placeholder="введите название видеоигры">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="producer" class="form-label">Студия разработчик</label>
                        <input type="text" value="{{ old('producer')}}" name="producer" class="form-control" id="producer" placeholder="введите название студии разработчика">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
