@extends('layout.main')
@section('content')
<div style="height: 30px;"></div>
<div class="container my-5">
    <h1 class="">
        CRUD
    </h1>
    <div class="alert alert-warning" role="alert">
        Чтоб увидеть изменения после операций CRUD не забудьте обновить эту страницу.
    </div>
    <div>
        <div class="mt-3">
            <div class="p-2 border mb-3">
                <h3 class="mb-3">Поиск видеоигр по категориям</h3>
                <div class="d-flex justify-content-between mb-3">
                    <form action="{{ url('/api/search') }}" method="GET">
                        <div class="d-flex gap-4 mb-3">
                            @foreach ( $categories as $key => $category)
                                <div class="form-check form-switch">
                                    <input name="categories[]" class="form-check-input" type="checkbox" role="switch" id="cat_{{ $category }}" 
                                    value="{{ $category }}">
                                    <label class="form-check-label" for="cat_{{ $category }}">{{ $key }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <button type="submit" class="btn btn-secondary btn-sm">Применить фильтр</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-center gap-5">
                <h3 class="my-4">Список видеоигр</h3>
                <div>
                    <a class="btn btn-success" href="{{ url('/create') }}">Добавить видеоигру</a>
                </div>
            </div>
            
            @if ( $videogames )

            <table class="table table-hover table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col"style="width:5%">id</th>
                        <th scope="col"style="width:20%">название видеоигры</th>
                        <th scope="col"style="width:20%">компания</th>
                        <th scope="col"style="width:40%">категории</th>
                        <th scope="col"style="width:15%">операции</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $videogames as $videogame)
                    <tr>
                        <th scope="row">{{ $videogame->id }}</th>
                        <td>{{ $videogame->name }}</td>
                        <td>{{ $videogame->producer }}</td>
                        <td>
                            <div>
                                @foreach($videogame->categories as $category)
                                <span class="badge text-bg-primary">{{ $category->name }}</span> 
                                    
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-primary btn-sm me-1" href="{{ url('/update') }}/{{ $videogame->id }}">редактировать</a>
                                <form action="{{ url('/api/delete') }}" method="POST">
                                    @csrf
                                    <input type="text" name="id" value="{{ $videogame->id }}" hidden>
                                    <div class="dropdown">
                                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            удалить
                                        </button>
                                        <ul class="dropdown-menu">
                                            <button type="submit" class="btn btn-danger btn-sm" >удалить видеоигру</button>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div>
                Ничего не найдено
            </div>
            @endif
            
        </div>
    </div>
</div>
@endsection