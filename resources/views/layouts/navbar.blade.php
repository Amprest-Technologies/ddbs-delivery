<nav class="navbar navbar-expand-lg navbar-laravel">
  <a class="navbar-brand{{ url()->current() === route('index') ? ' active' : ''}}" href="{{ route('index') }}">{{ config('app.name') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <img src="{{ asset('img/icon/menu.svg') }}" alt="Menu Icon" class="img-fluid navbar-toggler-icon">
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item{{ url()->current() === route('home') ? ' active' : ''}}">
        <a class="nav-link" href="{{ route('home') }}">
          Home
        </a>
      </li>
      <li class="nav-item{{ url()->current() === route('admin.index') ? ' active' : ''}}">
        <a class="nav-link" href="{{ route('admin.index') }}">
          Admin
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('admin.users', ['user'=>'customer']) }}">Customers</a>
          <a class="dropdown-item" href="{{ route('admin.users', ['user'=>'agent']) }}">Agents</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">SEARCH</button>
    </form>
  </div>
</nav>
