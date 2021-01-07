<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="resources/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

    <!-- Importar JQUERY SOLO para usar la libreria de dataTable -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <title>Administrador</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">            
            <h3 id="main-navbar" class="text-success mb-0">Libreria <span class="material-icons">local_library</span></h3>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{url('adm-libro')}}">Libros</a>
                    <a class="nav-link" href="{{url('adm-autor')}}">Autores</a>
                    <a class="nav-link" href="{{url('adm-editorial')}}">Editorial</a>
                </div>
            </div>
            <a href="{{url('/')}}" class="btn btn-outline-success">Volver</a>
        </div>
    </nav>
    <div class="container mt-3 mb-5">
        @yield('adm_content')
    </div>
  </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
<script src="resources/js/libreria.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>