<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery -->
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Sweetalert -->
    <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/b3dec1c31c.js" crossorigin="anonymous" defer></script>

    <!-- DataTable -->
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" ref="stylesheet">
    <script src="{{asset('js/jquery.dataTables.min.js')}}" defer></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}" defer></script>

    <!-- Google Font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');

        html,body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        <li class="nav-item">
                            @if(!session('member_login'))
                            <button class="btn btn-success" data-toggle="modal" data-target="#register_modal"><i class="fa fa-plus"></i> Register</button>
                            <div class="modal fade" tabindex="-1" role="dialog" id="register_modal">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                      <h5 class="modal-title">Member register</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('members.store')}}" method="POST">
                                            @csrf
                                            @method("POST")
                                    
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input class="form-control" type="text" id="txt_firstname" name="txt_firstname" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input class="form-control" type="text" id="txt_lastname" name="txt_lastname" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of birth</label>
                                                <input class="form-control" type="date" id="txt_dob" name="txt_dob" required>
                                            </div>
                                             <div class="form-group">
                                                <label>Username</label>
                                                <input class="form-control" type="text" id="txt_username" name="txt_username" required>
                                             </div>
                                             <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="password" id="txt_password" name="txt_password" required>
                                             </div>
                                             <div class="form-group">
                                                <button class="btn btn-success btn-block"><i class="fa fa-plus"></i> Register</button>
                                             </div>
                                            </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#login_modal"><i class="fas fa-sign-in-alt"></i> Login</button>
                            <div class="modal fade" tabindex="-1" role="dialog" id="login_modal">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                      <h5 class="modal-title">Member login</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="{{route('member_login')}}" method="POST">
                                        @csrf
                                        @method("GET")

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" type="text" id="txt_username" name="txt_username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" id="txt_password" name="txt_password" required>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit" id="btn_login"><i class="fas fa-sign-in-alt"></i> Login</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="member_dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Member :: {{ session('member_login.firstname')}} {{session('member_login.lastname')}}
                            </a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('my_profile')}}"><i class="fas fa-user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-clipboard-list"></i> Orders</a>
                                <a class="dropdown-item" herf="#"><i class="fas fa-address-book"></i> Address book</a>
                                <a class="dropdown-item" href="{{route('member_logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </li>
                        @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @guest
                        <li class="nav-item">
                            <a href="{{route('show_cart')}}" class="btn btn-warning">
                                @if(session('cart'))
                                @php
                                    $cart_count = 0;
                                @endphp
                                @foreach (session('cart') as $id => $item)
                                    @php
                                        $cart_count += $item['quantity'];
                                    @endphp
                                @endforeach
                                <span class="badge badge-pill badge-danger">
                                    {{number_format($cart_count)}}
                                </span>
                                @endif
                                
                                <i class="fas fa-shopping-cart"></i> Carts</a>
                        </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary" href="{{ route('login') }}"><i class="fas fa-user-cog"></i> Admin</a>
                                </li>
                            @endif
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('products.index')}}"><i class="fas fa-cubes"></i> Products</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-users"></i> Members</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
