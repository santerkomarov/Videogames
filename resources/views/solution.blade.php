@extends('layout.main')
@section('content')
<div class="container">
    <div style="height: 30px;"></div>
    <div class="container mt-5">
        <h1 class="my-4">
            Решение задачи
        </h1>
        <div>
            <div class=" mb-3 alert alert-success">
                <p>
                    Для решения задания я использовал фреймворк Laravel 8, а стили задаются библиотекой Bootstrap 5.
                </p>
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-3">Для просмотра исходников перейдите на Гитхаб </p>
                    <a class="link_github" href="{{ url('/api/games') }}">
                        <img src="{{ asset('assets/img/github.png')}}" class="" alt="github">
                    </a>
                </div>
                
            </div>
            <div class="alert alert-warning" role="alert">
                <p>
                    При выполнении этой задачи были опущены моменты оптимизации загрузки страниц, а валидация форм происходит только на сервере.<br>
                    Проверка работоспособности проводится как встроенными формами (create/update/delete), так и с помощью Postman.
                </p>
                <p>
                    Делая операции CRUD со страниц, ваши данные отправляются по АПИ роутерам, и ответ будет получен от них в формате JSON.<br>
                    Количество созданий видеоигр ограничено 20 шт.
                </p>
            </div>
            <div class="mb-5">
                <h3>
                    Схема БД, используемая в проекте
                </h3>
                <p>
                    Так как одина видеоигра может содержать несколько категорий, 
                    и сама категория может иметь несколько видеоигр, то здесь используются связи many-to-many.
                </p>
                <img src="{{ asset('assets/img/schema_db.jpg')}}" class="border" alt="schema_db">
            </div>

            <h4 class="mb-5">Список АПИ эндпоинтов</h4>
            <div class="mb-5">
                <div class="wrap-line">
                    <div class="line1">
                        GET
                    </div>
                    <div class="line2">
                        <span>http://apicrud/api/games &nbsp;&nbsp;&nbsp;</span>
                        <a class="" href="{{ url('/api/games') }}"> Смотреть список всех игр</a>
                    </div>
                </div>
                <details>
                    <summary>ПОКАЗАТЬ ОПИСАНИЕ</summary>
                    <div class="py-4">
                        <p><strong>Для тестировки в Postman: установите в параметрах ключи <span class="text-primary">categories[]</span> со значением от 1 до 5.</strong></p>
                        <ul>
                            <li>1 - приключения</li>
                            <li>2 - образовательная</li>
                            <li>3 - головоломка</li>
                            <li>4 - симуляция</li>
                            <li>5 - коллективная</li>
                        </ul>
                        <img src="{{ asset('assets/img/api_search.jpg')}}" class="border" alt="search">
                    </div>
                    
                </details>
            </div>

            <div class="mb-5">
                <div class="wrap-line">
                    <div class="line1" style="background-color: #ffd23f;">
                        GET
                    </div>
                    <div class="line2" style="background-color: #fff6d8;">
                        <span>http://apicrud/api/search </span>
                    </div>
                </div>
                <details>
                    <summary>ПОКАЗАТЬ ОПИСАНИЕ</summary>
                    <div class="py-4">
                        <p><strong>Для тестировки в Postman: установите в параметрах ключи <span class="text-primary">categories[]</span> со значением от 1 до 5.</strong></p>
                        <ul>
                            <li>1 - приключения</li>
                            <li>2 - образовательная</li>
                            <li>3 - головоломка</li>
                            <li>4 - симуляция</li>
                            <li>5 - коллективная</li>
                        </ul>
                        <img src="{{ asset('assets/img/api_search.jpg')}}" class="border" alt="search">
                    </div>
                    
                </details>
            </div>
            
            <div class="mb-5">
                <div class="wrap-line">
                    <div class="line1" style="background-color: #7dd181;">
                        POST
                    </div>
                    <div class="line2" style="background-color: #eef9ef;">
                        <span>http://apicrud/api/create &nbsp;&nbsp;&nbsp; </span>
                        <a class="" href="{{ url('/create') }}">Добавить игру в список через форму со страницы</a>
                    </div>
                </div>
                <details>
                    <summary>ПОКАЗАТЬ ОПИСАНИЕ</summary>
                    <div class="py-4">
                        <p><strong>Для тестировки в Postman: установите в параметрах ключи <span class="text-primary">categories[]</span> со значением от 1 до 5.</strong></p>
                        <ul>
                            <li>1 - приключения</li>
                            <li>2 - образовательная</li>
                            <li>3 - головоломка</li>
                            <li>4 - симуляция</li>
                            <li>5 - коллективная</li>
                        </ul>
                        <img src="{{ asset('assets/img/api_search.jpg')}}" class="border" alt="search">
                    </div>
                    
                </details>
            </div>

            <div class="mb-5">
                <div class="wrap-line">
                    <div class="line1" style="background-color: #ffd23f;">
                        POST
                    </div>
                    <div class="line2" style="background-color: #fff6d8;">
                        <span>http://apicrud/api/update </span>
                    </div>
                </div>
                <details>
                    <summary>ПОКАЗАТЬ ОПИСАНИЕ</summary>
                    <div class="py-4">
                        <p><strong>Для тестировки в Postman: установите в параметрах ключи <span class="text-primary">categories[]</span> со значением от 1 до 5.</strong></p>
                        <ul>
                            <li>1 - приключения</li>
                            <li>2 - образовательная</li>
                            <li>3 - головоломка</li>
                            <li>4 - симуляция</li>
                            <li>5 - коллективная</li>
                        </ul>
                        <img src="{{ asset('assets/img/api_search.jpg')}}" class="border" alt="search">
                    </div>
                    
                </details>
            </div>

            <div class="mb-5">
                <div class="wrap-line">
                    <div class="line1" style="background-color: #ea6298;">
                        POST
                    </div>
                    <div class="line2" style="background-color: #fbe1eb;">
                        <span>http://apicrud/api/delete</span>
                    </div>
                </div>
                <details>
                    <summary>ПОКАЗАТЬ ОПИСАНИЕ</summary>
                    <div class="py-4">
                        <p><strong>Для тестировки в Postman: установите в параметрах ключи <span class="text-primary">categories[]</span> со значением от 1 до 5.</strong></p>
                        <ul>
                            <li>1 - приключения</li>
                            <li>2 - образовательная</li>
                            <li>3 - головоломка</li>
                            <li>4 - симуляция</li>
                            <li>5 - коллективная</li>
                        </ul>
                        <img src="{{ asset('assets/img/api_search.jpg')}}" class="border" alt="search">
                    </div>
                    
                </details>
            </div>
        </div>
    </div>
</div>
@endsection
