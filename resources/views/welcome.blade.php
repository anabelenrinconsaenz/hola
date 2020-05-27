
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<! DOCTYPE html>
<head>
        <title>UNLPam - Biblioteca</title>
        <!--
          .menu se utilizó para el logo UNLPam y su menu debajo
          .titulo se utilizó para los titulos debajo del menu con fines de ayudar al usuario a identificar dónde se encuentra
          .container/.co-25/.col-75/.row y demás los utiliza Bootstrap
        -->
        <style>
       
            .menu {
                width: 96%;
                margin: auto;
                background-color: white;
            }
            
            .titulo {
                margin-top: 10px;
                background-color:#dfdcdd;
                margin-left: 50px;
                margin-right: 50px;
                display: flex;
            }
            
            * {
                box-sizing: border-box;
              }
              input[type=text], select, textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
              }
              label {
                padding: 12px 12px 12px 0;
                display: inline-block;
              }
              input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
              }
              input[type=submit]:hover {
                background-color: #45a049;
              }
              .container {
                padding: 20px;
              }
              .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
              }
              .col-75 {
                float: left;
                width: 75%;
                margin-top: 6px;
              }
              table th {
                text-align: center;
              }
              table td {
                text-align: center;
              }
              /* Clear floats after the columns */
              .row:after {
                content: "";
                display: table;
                clear: both;
              }
              /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
              @media screen and (max-width: 600px) {
                .col-25, .col-75, input[type=submit] {
                  width: 100%;
                  margin-top: 0;
                }
              }
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="https://kit.fontawesome.com/0c4b5fe221.js" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/ventas.css">
    </head>
    <body style="background-color:#dfdcdd;">

      {{-- Seccion del logo y nombre del usuario --}}
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="{{asset('imagen/UniversidadNacionaldeLaPampa.png')}}">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-size: 1.25em" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>
      
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Cerrar Sesion
                  </a>
      
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav> 
      {{-- FIN Seccion del logo y nombre del usuario --}}

        <div>
            <!--
                El menu todavía no es la version final se pueden realizar cambios para mejorar la interacción del usuario con el mismo
            -->
            <nav class="navbar navbar-expand-sm navbar-dark justify-content-center" style="background: #848484;">
                <ul class="navbar-nav" style="margin: -5px;">
                    <!-- Dropdown -->
                    <li class="nav-item" >
                      <a class="nav-link font-weight-bold" href="paginaprincipal" style="width: 125px;text-align: center;">
                        Libros
                      </a>
                    </li>
                    
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="ventadrop" data-toggle="dropdown" style="width: 125px;text-align: center;">
                        Ventas
                      </a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Mensuales</a>
                        <a class="dropdown-item" href="#">Anuales</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/altaVentas">Nueva venta</a>
                        <a class="dropdown-item" href="/todasVentas">Ventas</a>
                      </div>
                    </li>
                    
                    <li class="nav-item dropdown" >
                     <li class="nav-item" >
                      <a class="nav-link font-weight-bold" href="/cliente" style="width: 125px;text-align: center;">
                        Clientes
                      </a>
                    </li>
                    
                    <li>
                      <a class="nav-link font-weight-bold" href="/descuento"style="width: 125px;text-align: center;">
                        Descuento
                      </a>
                    </li>
                    <li>
                      <a class="nav-link font-weight-bold" href="/talonario"style="width: 125px">
                        Talonarios
                      </a>
                    </li>

                    <li>
                      <a class="nav-link font-weight-bold" href="/exelFunciones"style="width: 100px;text-align: center;">
                        Excel
                      </a>
                    </li>

                    <li class="nav-item dropdown" >
                      <a class="nav-link font-weight-bold" href="{{url('notificaciones')}}" style="width: 60px;text-align: center;">
                        <i class="fa fa-bell-o"></i>
                      </a>
                    </li>
                </ul>
            </nav>
        </div>
</head>
 
<div>
    @yield('content')
</div>
            
</html>
