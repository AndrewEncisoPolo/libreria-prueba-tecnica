<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <title>Biblioteca</title>
  </head>
  <body>
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <h3 id="main-navbar" class="text-success mb-0">Libreria <span class="material-icons">local_library</span></h3>
            <a href="{{url('adm-libro')}}" class="btn btn-outline-success">Administrar</a>
        </div>
    </nav>

    <div class="container mt-3 mb-5">
        <h2 class="pb-3">Lista de Libros</h2>
        <div class="row">
            @foreach ($lista_libros as $item)
                <div class="col-sm-12 col-md-6 col-lg-4 form-group">
                    <div class="card card-body border-0 shadow-sm rounded-card card-pointer" data-bs-toggle="modal" data-bs-target="#detalle-libro" onclick="verLibro({{$item->ISBN}})">
                        <h5 class="text-dark">{{$item->Titulo}}</h5>
                        <span class="material-icons m-auto coverpage mb-2">book</span>
                        <span class="m-auto text-dark pb-2">Autor: <span class="text-muted">{{$item->Autor}}</span></span>
                        <button class="btn btn-sm btn-success rounded-btn" value="1">Ver más</button>
                    </div>
                </div>               
            @endforeach
        </div>
    </div>

  </body>
</html>

<div id="detalle-libro" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h4 id="titulo-libro-modal" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-2">
                <div class="row pb-2">
                    <div class="col-sm-12 col-md-12 col-lg-4 text-center">
                        <span class="material-icons coverpage align-middle">book</span>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <p>Sinopsis</p>
                        <span id="sinopsis-libro-modal" class="text-muted"></span>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 pt-2">
                        <span class="text-dark">Autor: 
                            <span id="autor-libro-modal" class="text-muted"></span>
                        </span>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 pt-2">
                        <span class="text-dark">Número de páginas: 
                            <span id="nro-paginas-libro-modal" class="text-muted"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function verLibro(id){
        let formData = new FormData();formData.append("ISBN", id);formData.append("_token", "{{csrf_token()}}"); 
        let xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
        xobj.open("POST", "{{route('obtener-detalle-libro')}}", true);
        xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == "200") {
                var p = JSON.parse(xobj.responseText);
                document.getElementById("titulo-libro-modal").innerHTML = p[0].Titulo,
                document.getElementById("sinopsis-libro-modal").innerHTML = p[0].Sinopsis,
                document.getElementById("autor-libro-modal").innerHTML = p[0].Autor,
                document.getElementById("nro-paginas-libro-modal").innerHTML = p[0].NroPaginas;
            }
        };
        xobj.send(formData);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
<script src="resources/js/libreria.js"></script>