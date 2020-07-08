<!DOCTYPE html>
<html lang="en">
<!-----------------------------------------Head-------------------------------------------------->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Wizag Interview Kiprop">
  <meta name="author" content="Kelvin Kiprop">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Title -->
  <title>{{ config('app.name', 'Wizag Interview Kiprop') }}</title>  
  <!--FivoIcon-->
  <link href="/images/logo.jpg" rel="icon" type="image/x-icon" />   
  <!--Animate-->
  <link rel="stylesheet" href="{{ asset('animate.css-master/animate.css') }}"/>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/main.js')}}" defer></script>
  <!-- Bootstrap -->
  <link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.min.css') }}"  rel="stylesheet">
  <!-- Font awesome -->
  <link href="{{ asset('fontawesome-free-5.10.2-web/css/all.min.css') }}" rel="stylesheet"> 
  <!-- Styles -->
  <link href="{{ asset('styles/main.css') }}" rel="stylesheet">

</head>
<!-----------------------------------------./Head-------------------------------------------------->

<!-----------------------------------------Body-------------------------------------------------->
<body>

    <!-----------------------------------------Preloader--------------------------------------------------->
    <div id="preloader">
        <div id="status">
            <div class="spinner-grow text-warning"></div>
            <div class="spinner-grow text-secondary"></div>
            <div class="spinner-grow text-info"></div>
        </div>
    </div>
    <!-----------------------------------------./Preloader--------------------------------------------------->

    <!-----------------------------------------Navigation--------------------------------------------------->
    <section id="navigation">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <!-- Toggler button -->
                <button type="button" class="navbar-toggler navbar-toggler-right text-white" data-toggle="collapse" data-target="#mynavbar" 
                    aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <img src="images/logo.jpg" alt="logo" height="35" width="35" class="logo rounded-circle img-thumbnail" />
                <a class="navbar-brand" href="home">{{config('app.name')}}</a>

                <!-- Navbar collapse -->
                <div class="collapse navbar-collapse" id="mynavbar">

                    <!-- Right Links -->
                    <ul class="navbar-nav ml-auto">                          
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>                             
                            <li class="nav-item">
                                <label class="nav-link">|</label>
                            </li>
                        @guest 
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>                            
                            <li class="nav-item">
                                <label class="nav-link">|</label>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Register</a>
                            </li>
                        @else  
                            <!-- Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">{{Auth::user()->name}}</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/add item"><i class="fas fa-pen" aria-hidden="true">&nbsp;Add Item</i></a>
                                    <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt" aria-hidden="true">&nbsp;Logout</i></a>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            
            </div>    
        </nav>
    </section>
    <!-----------------------------------------./Navigation--------------------------------------------------->


    <!-----------------------------------------Home--------------------------------------------------->
    <section id="home">
        <div class="welcome">
            <div class="preview">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="preview-text">
                                <h3 class="text-white">An interview question to populate a table by Kelvin Kiprop</h3>
                                <div class="mt-4">
                                    <a href="/add item"  class="btn btn-info">ADD AN ITEM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="hero">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="hero-square">
                                <i class="hero-icon fas fa-gift fa-3x" aria-hidden="true"></i>                                
                                <h6 class="hero-text">Easy to Use</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="hero-square">
                                <i class="hero-icon fas fa-fighter-jet fa-3x" aria-hidden="true"></i>                                
                                <h6 class="hero-text">Simple and Quick</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="hero-square">
                                <i class="hero-icon fas fa-spinner fa-3x" aria-hidden="true"></i>                                
                                <h6 class="hero-text">Beautiful and fast loading</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-----------------------------------------./Home--------------------------------------------------->


    <!-----------------------------------------Footer-------------------------------------------------->
    @include('inc.footer')
    <!-----------------------------------------./Footer--------------------------------------------------->
    
</body>
<!-----------------------------------------./Body-------------------------------------------------->

    <!-- Boostrap JS -->
    <script src="{{ asset('bootstrap-4.3.1-dist/js/bootstrap.min.js') }}"></script>

</html> 