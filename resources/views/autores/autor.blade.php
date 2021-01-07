@extends('administrador')

@section('adm_content')
    
    <div class="container mt-3">
        <div class="row" style="padding-top:1rem;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 2rem;">
                <h3>Autores <button class="btn btn-outline-success float-right" data-bs-toggle="modal" data-bs-target="#registrar-autor" style="float:right">Registrar Autor</button></h3>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-group">
                <table id="tabla-autor" class="display" style="width:100%;border-bottom: 0px solid #111;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Autor</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registrar-autor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="registrar-autor-needs-validation" novalidate>
                        <div class="row">
                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                <h2>Registrar Editorial</h2>
                            </div>
                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 py-2">
                                <div id="false_registro" style="display: none;">
                                    <div class="alert alert-danger" role="alert" style="border-radius: 0.25rem;margin-bottom: 0px;">
                                        Hubo un error en la ejecución, por favor intente de nuevo.
                                    </div>
                                </div>

                                <div id="ok_registro" style="display: none;">
                                    <div class="alert alert-success" role="alert" style="border-radius: 0.25rem;margin-bottom: 0px;">
                                        El Autor se ha registrado satisfactoriamente.
                                    </div>
                                </div>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-3">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" type="text" name="nombre" id="nombre" required>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-3">
                                <label for="apellido">Apellidos</label>
                                <input class="form-control" type="text" name="apellido" id="apellido" required>
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
            getAutores();
        });

        function getAutores(){
            $('#tabla-autor').DataTable( {
                "language": {"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
                "destroy": "true",
                "ajax": {"url": "{{route('obtener-autores')}}","dataSrc": ""},
                "columns":[
                    {data: 'id'},
                    {data: 'Autor'}
                ]
            });               
        }

        (function() {'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('registrar-autor-needs-validation');
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

                        var nombre = $("#nombre").val();
                        var apellido = $("#apellido").val();

                        if (!nombre==""||!apellido==""){crear = 1;}

                        if(crear==1){
                            $.ajax({
                            url:"{{route('registrar-autor')}}",
                            method:"POST",
                            data:{Nombre:nombre,Apellido:apellido,_token:_token},
                            success:function(result)
                                {
                                    if(result==1){
                                        $("#nombre").val("");
                                        $("#apellido").val("");

                                        document.getElementById("ok_registro").style.display="block";
                                        document.getElementById("false_registro").style.display="none";
                                        $('#ok_registro').delay(5000).hide(0);
                                        form.classList.remove('was-validated');
                                        getAutores();
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