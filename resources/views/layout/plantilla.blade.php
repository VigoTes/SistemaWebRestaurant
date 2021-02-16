<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Blank Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
 <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">

 <link rel="stylesheet" href="/calendario/css/bootstrap-datepicker.standalone.css">
 <link rel="stylesheet" href="/select2/bootstrap-select.min.css">
 
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 


  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @yield('estilos')

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

     

    </ul>
    
    <!-- SEARCH FORM -->
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
     
    </ul>
  </nav>
  <!-- /.navbar -->
 {{--  {{route('bienvenido')}} --}}
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/bienvenido') }}" class="brand-link">
      <img src="/adminlte/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
     
        @if(Auth::id()!='') {{-- Si está logeado y no es admin --}}
        <div class="info">
          <a href="#" class="d-block">
           {{ App\Empleado::getEmpleadoLogeado()->getNombreCompleto()}}
           <br>
            <b>{{ App\Empleado::getEmpleadoLogeado()->getTipoTrabajador()}}
            </b>
           
          </a>
        </div>
        @endif
        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('orden.listarSalas')}}" class="nav-link">
              <i class="fab fa-free-code-camp"></i>
              <p>Vista Mesero Salas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('orden.listarParaMesero')}}" class="nav-link">
              <i class="fab fa-free-code-camp"></i>
              <p>Vista Mesero Ordenes</p>
            </a>
          </li>
          

          <li class="nav-item">
            <a href="{{route('orden.listarParaCocina')}}" class="nav-link">
              <i class="fab fa-free-code-camp"></i>
              <p>Vista Cocina</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('orden.listarParaCaja')}}" class="nav-link">
              <i class="fab fa-free-code-camp"></i>
              <p>Vista Cajero</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('caja.index')}}" class="nav-link">
              <i class="fab fa-free-code-camp"></i>
              <p>Visualizar Cajero</p>
            </a>
          </li>
          
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Mantenimiento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('categoria.index')}}" class="nav-link">
                  <i class="far fa-address-card nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('producto.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('empleados.ver')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empleados</p>
                </a>
              </li>
              
              <!--
              <li class="nav-item">
                <a href="{{route('cliente.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('unidad.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unidades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cabeceraventa.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ventas</p>
                </a>
              </li>
            -->


            </ul>

          </li>
          <li class="nav-item">
            <a href="{{route('user.cerrarSesion')}}" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Cerrar Sesión
              </p>
            </a>
          </li>
         </ul>
      </nav>






      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    {{-- 
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h5 class="m-0 text-dark"> <strong> Gestion de Ventas</strong></h5>
   
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> --}}

    <!-- Main content -->
    <section class="content">
        @yield('contenido')
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 @yield('script')
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>

<!-- PARA SOLUCIONAR EL PROBLEMA DE 'funcion(){' EN js--->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<!-- LIBRERIAS PARA NOTIFICACION DE ELIMINACION--->
<script src="/adminlte/dist/js/sweetalert.min.js"></script>
<link rel="stylesheet" href="/adminlte/dist/css/sweetalert.css">

<script src="/select2/bootstrap-select.min.js"></script>   

<script src="/calendario/js/bootstrap-datepicker.min.js"></script>
<script src="/calendario/locales/bootstrap-datepicker.es.min.js"></script>


</body>
</html>