<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FatNerdEat</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
			.rwd-table {
		 	 background: #fff;
		 	 overflow: hidden;
			}

			.rwd-table tr:nth-of-type(2n){
			  background: #eee;
			}
			.rwd-table th, 
			.rwd-table td {
			  margin: 0.5em 1em;
			}
			.rwd-table {
			  min-width: 100%;
			}

			.rwd-table th {
			  display: none;
			}

			.rwd-table td {
			  display: block;
			}

			.rwd-table td:before {
			  content: attr(data-th) " : ";
			  font-weight: bold;
			  width: 6.5em;
			  display: inline-block;
			}

			.rwd-table th, .rwd-table td {
			  text-align: left;
         
			}

			.rwd-table th, .rwd-table td:before {
			  color: black;
			  font-weight: bold;
        
			}

			@media (min-width: 480px) {
			  .rwd-table td:before {
			    display: none;
			  }
			 .rwd-table th, .rwd-table td {
			    display: table-cell;
			    padding: 0.25em 0.5em;
			  }
			  .rwd-table th:first-child, 
			  .rwd-table td:first-child {
			    padding-left: 0;
			  }
			  .rwd-table th:last-child, 
			  .rwd-table td:last-child {
			    padding-right: 0;
			  }
			   .rwd-table th, 
			   .rwd-table td {
			    padding: 1em !important;
			  }
			}
		</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    FatNerdEat
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    
                                    @if (Auth::user()->type=="Store")
                                        <a class="dropdown-item" href="{{ route('home') }}">{{ __('Store Information') }}</a>
                                        <a class="dropdown-item" href="{{ route('myDish') }}">{{ __('My Dish') }}</a>
                                        
                                    @endif

                                    @if (Auth::user()->type=="Deliver")
                                        <a class="dropdown-item" href="{{ route('orderList_Deliver') }}">{{ __('Receive Order') }}</a>
                                        
                                    @endif

                                    @if (Auth::user()->type=="Customer")
                                        <a class="dropdown-item" href="{{ route('storeinfo') }}">{{ __('Store') }}</a>
                                        
                                    @endif
                
                                    <a class="dropdown-item" href="{{ route('myOrderList') }}">{{ __('My Order') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    @yield('script')
    
</body>


</html>
