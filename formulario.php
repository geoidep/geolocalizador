<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FORMULARIO</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>

<body>
    <div class= "container" id="wrapper">
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registro de ...</h1>
                </div>
            </div>
            <div class="panel-body">
                <form>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nombre:</label>
                      <div class="col-sm-4">
                        <input class="form-control" id="nombre" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Departamento:</label>
                      <div class="col-sm-4">
                          <select id="selectDepartamento" class="selectpicker" data-live-search="true">
                            <option value="9999">SELECCIONAR</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Provincia:</label>
                      <div class="col-sm-4">
                          <select id="selectProvincia" class="selectpicker" data-live-search="true">
                            <option value="9999">SELECCIONAR</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Distrito:</label>
                      <div class="col-sm-4">
                          <select id="selectDistrito" class="selectpicker" data-live-search="true">
                            <option value="9999">SELECCIONAR</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Dirección:</label>
                      <div class="col-sm-4">
                        <input class="form-control" id="direccion" >
                      </div>
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-success" id="btnUbicar">UBICAR</button>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <input class="form-control" id="lat" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <input class="form-control" id="lon" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button class="btn btn-primary" id ="btninsertarpersona">Registrar</button>
                      </div>
                    </div>

                </form>
                    <!--div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button class="btn btn-secondary  btn-block" id ="btnvermapa">Ver Mapa</button>
                      </div>
                    </div-->
            </div>
            <footer>
                <div id="modalUbicar" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">UBICAR DIRECCIÓN</h4>
                            </div>
                            <div class="modal-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                  <iframe id="iframeUbicar" class="embed-responsive-item" src=""></iframe>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btnGuardarUbicacion" type="button" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script>
 var urlSWrest = "http://geoidep.gob.pe/georreferencia/service/json/";
 var urlAPI = "http://geoidep.gob.pe/georreferencia/api/index.php";
 
 var get_departamento = function() {
    $.ajax({
        url: urlSWrest+"departamento.php",
        type: "POST",
        datatype: 'json',
        success: function(data) {
            cargar_select(data, "#selectDepartamento");
        },
        error: function(obj, err, oterr) {
        }
    });
 };
 
 var get_provincia = function(coddep) {
    $.ajax({
        url: urlSWrest+'provincia.php',
        type: "POST",
        datatype: 'json',
        data: { coddep : coddep },
        success: function(data) {
            cargar_select(data, "#selectProvincia");
        },
        error: function(obj, err, oterr) {
        }
    });
 };

 var get_distrito = function(codpro) {
    $.ajax({
        url: urlSWrest+'distrito.php',
        type: "POST",
        datatype: 'json',
        data: { codpro : codpro },
        success: function(data) {
            cargar_select(data, "#selectDistrito");
        },
        error: function(obj, err, oterr) {
        }
    });
 };

 var cargar_select = function (data, select_id) {

    $(select_id).find('option').remove().end();
    if(select_id=="#selectProvincia"){ get_distrito(data["LISTA"][0]["codigo"]); $("#selectDistrito").selectpicker('refresh');}
    $.each(data["LISTA"], function (i, item) {
        $(select_id).append($('<option>', {
            value: item.codigo,
            text : item.valor
        }));
    });
    $(select_id).selectpicker('refresh');
    $(select_id).selectpicker('deselectAll');
    $(select_id).selectpicker('refresh');
};

 $(document).ready(function(e){

     get_departamento();
     get_provincia('15');
     get_distrito('1501');

     $('#selectDepartamento').change(function() {
         get_provincia(this.value.toString());
     });

     $('#selectProvincia').change(function() {
         get_distrito(this.value.toString());
     });

     $("#btnUbicar").click(function(){
         $("#modalUbicar").modal('show');
         $("#modalUbicar").find('#iframeUbicar').attr('src',urlAPI+'?codigo='+$("#selectDistrito").val());
     });
     
/*--Guardar Persona--*/
     $("#btninsertarpersona").click(function(){
        nombre    = $("#nombre").val();
        ubigeo    = $("#selectDistrito").val();
        direccion = $("#direccion").val();
        x         = $("#lon").val();
        y         = $("#lat").val();
        $.ajax({
            url: urlSWrest+'registrarPersona.php',
            type: "POST",
            datatype: 'json',
            data: {nombre:nombre,ubigeo:ubigeo,direccion:direccion,x:x,y:y},
            success: function(data) {
            },
            error: function(obj, err, oterr) {
                alert("Guardado!");
            }
        });
    });
/*--Ver Mapa--*/
    /* $("#btnvermapa").click(function(){
        window.open('vermapa/', '_blank');//http://localhost/
    });*/
});

 $("#btnGuardarUbicacion").click(function(){
    var iframe = $('#iframeUbicar').contents();
    $("#lat").val(iframe.find("#latitud").val());
    $("#lon").val(iframe.find("#longitud").val());
    $('#modalUbicar').modal('toggle');
 });
</script>
</body>
</html>