<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <!-- CSRF Token -->
  <meta name="csrf-token"
    content="{{ csrf_token() }}">

  <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">

    <!-- Header -->
    <nav class="app-header navbar navbar-expand bg-body">
      <div @class([
          'container' => !auth()->check(),
          'container-fluid' => auth()->check(),
      ])>

        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link"
                data-lte-toggle="sidebar"
                href="#"
                role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
          @else
            <li class="nav-item sidebar-brand border-0">
              <a class="nav-link brand-link"
                href="/"><span class="brand-text fw-light">{{ config('app.name') }}</span></a>
            </li>
          @endauth
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <!-- Authentication Links -->
          @guest
            @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link"
                  href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link"
                  href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown"
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdown">
                <a class="dropdown-item"
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST"
                  class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </nav>

    @auth
      <!-- Sidebar -->
      <aside class="app-sidebar bg-body-secondary shadow"
        data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="#"
            class="brand-link">
            <span class="brand-text fw-light">{{ config('app.name') }}</span>
          </a>
        </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu">
              <li class="nav-item">
                <a href="#"
                  class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#"
                  class="nav-link">
                  <i class="nav-icon bi bi-bar-chart"></i>
                  <p>Reports</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
    @endauth

    <!-- Main content -->
    <main @class(['app-main', 'mt-3' => $hide_title ?? false])>
      @unless ($hide_title ?? false)
        <div class="app-content-header">
          <div @class([
              'container' => !auth()->check(),
              'container-fluid' => auth()->check(),
          ])>
            <h3 class="mb-0">{{ $content_title ?? ($title ?? config('app.name', 'Laravel')) }}</h3>
          </div>
        </div>
      @endunless

      <div class="app-content">
        <div @class([
            'container' => !auth()->check(),
            'container-fluid' => auth()->check(),
        ])>
          {{-- <div class="card">
            <div class="card-header">
              <h5 class="card-title">Welcome</h5>
            </div>
            <div class="card-body">
              Edit this file to start building your dashboard.
            </div>
          </div> --}}
          @yield('content')
        </div>
      </div>
    </main>

  </div>
</body>

</html>
