<div class="fixed-top">
 <nav class="navbar navbar-expand-md bg-body-tertiary bg-dark" data-bs-theme="light">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">
      <img src="../imagenes/logo.jpg" alt="Bootstrap" width="70" height="70">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active text-white" href="{{Route('index')}}">Home
            <span class="visually-hidden">(current)</span> 
          </a>
        </li>
        @guest
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Mas informacion</a>
          <div class="dropdown-menu bg-body-secondary border border-0 bg-dark">
            @if (Route::has('login'))
               <a class="dropdown-item text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
            @endif
            @if (Route::has('register'))
              <a class="dropdown-item text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
          </div>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link text-white" href="{{Route('roles.index')}}">Roles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{Route('usuarios.index')}}">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{Route('clientes.index')}}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{Route('perfiles.index')}}">Perfiles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{Route('facturas.index')}}">Facturacion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{Route('productos.index')}}">Productos</a>
        </li>
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-end bg-body-secondary" aria-labelledby="navbarDropdown">
            <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav> 
</div>

<style>
  .dropdown-menu .dropdown-item {
    color: white !important;
  }
</style>
