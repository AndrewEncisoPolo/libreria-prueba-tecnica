@extends('administrador')

@section('adm_content')
    
    <div class="container mt-3">
        <div class="row" style="padding-top:1rem;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 2rem;">
                <h3>Editorial <button class="btn btn-outline-success float-right" data-bs-toggle="modal" data-bs-target="#registrar-editorial" style="float:right">Registrar Editorial</button></h3>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-group">
                <table id="tabla-editorial" class="display" style="width:100%;border-bottom: 0px solid #111;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Sede</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registrar-editorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="registrar-editorial-needs-validation" novalidate>
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
                                        La Editorial se ha registrado satisfactoriamente.
                                    </div>
                                </div>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-3">
                                <label for="editorial">Editorial</label>
                                <input class="form-control" type="text" name="editorial" id="editorial" required>
                            </div>

                            <div class="col-xsm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-3">
                                <label for="sede">Sede</label>
                                <input class="form-control" type="text" name="sede" id="sede" required>
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
            getEditoriales();
        });

        function getEditoriales(){
            $('#tabla-editorial').DataTable( {
                "language": {"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
                "destroy": "true",
                "ajax": {"url": "{{route('obtener-editoriales')}}","dataSrc": ""},
                "columns":[
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'sede'}
                ]
            });               
        }

        (function() {'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('registrar-editorial-needs-validation');
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

                        var editorial = $("#editorial").val();
                        var sede = $("#sede").val();

                        if (!editorial==""||!sede==""){crear = 1;}

                        if(crear==1){
                            $.ajax({
                            url:"{{route('registrar-editorial')}}",
                            method:"POST",
                            data:{Editorial:editorial,Sede:sede,_token:_token},
                            success:function(result)
                                {
                                    if(result==1){
                                        $("#editorial").val("");
                                        $("#sede").val("");

                                        document.getElementById("ok_registro").style.display="block";
                                        document.getElementById("false_registro").style.display="none";
                                        $('#ok_registro').delay(5000).hide(0);
                                        form.classList.remove('was-validated');
                                        getEditoriales();
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



