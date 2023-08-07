<div>
  <nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark shadow">
    <div class="container">
      <h4><a class="nav-link text-warning h4 me-5" href="{{ url('https://abergan.ru/') }}">abergan.ru</a></h4>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ url('/') }}">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('solution')) ? 'active' : '' }}" href="{{ url('/solution') }}">Решение</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('show')) ? 'active' : '' }}" href="{{ url('/show') }}">CRUD</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>