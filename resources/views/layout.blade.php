<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">

  @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
  @endauth
</head>

<body>
  <div id='app'>
    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark d-flex justify-content-between">
      <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <search-bar></search-bar>
        <ul class="navbar-nav">
          <li class="nav-item dropdown text-right">
            <a class="nav-link dropdown-toggle" href="#" id="dropdowncategories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Animés</a>
            <div class="dropdown-menu" aria-labelledby="dropdowncategories">
              <a class="dropdown-item" href="{{ route('animesList') }}">
                Liste des animés
              </a>
              <a class="dropdown-item" href="{{ route('addAnimeForm') }}">
                Ajouter un animé
              </a>
            </div>
          </li>
        </ul>
      </div>

      <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route ('register') }}">Inscription</a>
        </li>
        @else
        <li class="nav-item dropdown text-right">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">
              Profil
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Déconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </nav>

    <div class="container my-5">
      @yield('content')
    </div>

    <footer class="container sticky-bottom">
      <hr>
      <p>Maureen Bruihier 2020</p>
    </footer>
  </div>

  <script>
    window.Laravel = {
      user: @json(Auth::user())
    }
  </script>
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="https://kit.fontawesome.com/04d573739c.js" crossorigin="anonymous"></script>
  

</body>

</html>