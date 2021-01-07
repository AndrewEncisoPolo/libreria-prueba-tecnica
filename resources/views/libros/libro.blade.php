@extends('administrador')

@section('adm_content')
    
    <div class="container mt-3">
        <div class="row" style="padding-top:1rem;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 2rem;">
                <h3>Libros <button class="btn btn-outline-success float-right" data-bs-toggle="modal" data-bs-target="#registrar-libro" style="float:right">Registrar Libro</button></h3>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-group">
                <table id="tabla-libros" class="display" style="width:100%;border-bottom: 0px solid #111;">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Editorial</th>
                            <th>Título</th>
                            <th>Sinopsis</th>
                            <th># Páginas</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registrar-libro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="registrar-libro-needs-validation" novalidate>
                        <div class="row">
                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                <h2>Registrar Libro</h2>
                            </div>
                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 py-2">
                                <div id="false_registro" style="display: none;">
                                    <div class="alert alert-danger" role="alert" style="border-radius: 0.25rem;margin-bottom: 0px;">
                                        Hubo un error en la ejecución, por favor intente de nuevo.
                                    </div>
                                </div>

                                <div id="ok_registro" style="display: none;">
                                    <div class="alert alert-success" role="alert" style="border-radius: 0.25rem;margin-bottom: 0px;">
                                        El Libro se ha registrado satisfactoriamente.
                                    </div>
                                </div>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 pb-3">
                                <label for="autor">Autor</label>
                                <select class="form-control" name="autor" id="autor" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($data_autor as $item)
                                        <option value="{{$item->id}}">{{$item->Autor}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 pb-3">
                                <label for="editorial">Editorial</label>
                                <select class="form-control" name="editorial" id="editorial" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($data_editorial as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-3">
                                <label for="tituloLibro">Título del Libro</label>
                                <input class="form-control" type="text" name="tituloLibro" id="tituloLibro" required>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-3">
                                <label for="sinopsis">Sinopsis</label>
                                <textarea class="form-control" name="sinopsis" id="sinopsis" required style="height: 200px"></textarea>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 pb-3">
                                <label for="nroPaginas">Número de páginas</label>
                                <input class="form-control" type="text" name="nroPaginas" id="nroPaginas" required>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 pb-3">
                                <label for="isbn">ISBN</label>
                                <input class="form-control" type="text" name="isbn" id="isbn" minlength="10" maxlength="13" onkeypress="isInputNumber(event)" required>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-2">
                                <button class="btn btn-sm btn-success" type="submit" style="width:100%">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            getLibros();
        });

        function getLibros(){
            $('#tabla-libros').DataTable( {
                "language": {"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
                "destroy": "true",
                "ajax": {"url": "{{route('obtener-libros')}}","dataSrc": ""},
                "columns":[
                    {data: 'ISBN'},
                    {data: 'editorial'},
                    {data: 'titulo'},
                    {data: 'sinopsis'},
                    {data: 'n_paginas'}
                ]
            });               
        }

        (function() {'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('registrar-libro-needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                
                form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                    if (form.checkValidity() === false) {
                        console.log("campos vacios");
                        form.classList.add('was-validated');
                    }else{
                        var crear = 0;
                        var _token = "{{csrf_token()}}";

                        var isbn = $("#isbn").val();
                        var autor = $("#autor").val();
                        var editorial = $("#editorial").val();
                        var tituloLibro = $("#tituloLibro").val();
                        var sinopsis = $("#sinopsis").val();
                        var nroPaginas = $("#nroPaginas").val();

                        if (!autor==""||!editorial==""||!tituloLibro==""||!sinopsis==""||!nroPaginas==""){crear = 1;}

                        if(crear==1){
                            $.ajax({
                            url:"{{route('registrar-libro')}}",
                            method:"POST",
                            data:{ISBN:isbn,Autor:autor,Editorial:editorial,TituloLibro:tituloLibro,Sinopsis:sinopsis,NroPaginas:nroPaginas,_token:_token},
                            success:function(result)
                                {
                                    if(result==1){
                                        $("#isbn").val("");
                                        $("#autor").val("");
                                        $("#editorial").val("");
                                        $("#tituloLibro").val("");
                                        $("#sinopsis").val("");
                                        $("#nroPaginas").val("");

                                        document.getElementById("ok_registro").style.display="block";
                                        document.getElementById("false_registro").style.display="none";
                                        $('#ok_registro').delay(5000).hide(0);
                                        form.classList.remove('was-validated');
                                        getLibros();
                                    }else{
                                        document.getElementById("ok_registro").style.display="none";
                                        document.getElementById("false_registro").style.display="block";
                                    }
                                }
                            })
                        }
                    }

                }, false);
                });
            }, false);
            })();

    </script>

@endsection