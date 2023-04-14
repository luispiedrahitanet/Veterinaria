<?php
    if (!isset($_SESSION["usu_id"])) {
        header('Location: ../login.php');
    }

    include('bin/Animal.php');

    $usuarios = new Animal();
    $datos = $usuarios->get_animal();

?>

<link href="view/public/gijgo/gijgo.min.css" rel="stylesheet">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary mb-3 float-left">ANIMALES</h6>
        <a href="#" type="button" class="btn btn-primary btn-icon-split float-right " id="btnNuevoAnimal" data-toggle="modal" data-target="#modalAnimal">
        <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
        <span class="text">Nuevo animal</span>
        </a>
    </div>
    <div class="card-body w-100">
        <div class="table-responsive">
            <table class="table table-bordered table-hover row-border shadow-sm rounded"  id="dtAnimales">
                <thead>
                    <tr class="text-nowrap">
                        <th><i class="fas fa-sort"></i> Céd dueño</th>
                        <th><i class="fas fa-sort"></i> Código</th>
                        <th><i class="fas fa-sort"></i> Nombre</th>
                        <th><i class="fas fa-sort"></i> F. nacimiento</th>
                        <th><i class="fas fa-sort"></i> Raza</th>
                        <th><i class="fas fa-sort"></i> Genero</th>
                        <th><i class="fas fa-sort"></i> F. ingreso</th>
                        <th> Acción </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-nowrap">
                        <th>Céd dueño</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>F. nacimiento</th>
                        <th>Raza</th>
                        <th>Genero</th>
                        <th>F. ingreso</th>
                        <th> Acción </th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach($datos as $registro){
                    echo "<tr>";
                    echo "<td>" . $registro['anim_ced_cli'] . "</td>";
                    echo "<td>" . $registro['cod_animal'] . "</td>";
                    echo "<td>" . $registro['anim_nombre'] . "</td>";
                    echo "<td>" . substr($registro['anim_fech_nacido'], 0, 10) . "</td>";
                    echo "<td>" . $registro['raza_raza'] . "</td>";
                    echo "<td>" . $registro['gene_genero'] . "</td>";
                    echo "<td>" . substr($registro['anim_fech_ingreso'], 0, 10) . "</td>";
                    echo "<td class='text-nowrap'> <a href='#'><i class='editarAnimal fas fa-edit text-primary ml-2' data-toggle='modal' data-target='#modalAnimal'></i></a>
                    <a href='#'><i class='eliminarAnimal fas fa-trash-alt text-danger ml-2' data-toggle='modal' data-target='#modalAnimal'></i></a></td>";
                    echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Usuarios -->
<div class="modal fade" id="modalAnimal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ml-4 mr-4">
        <form id="formAnimal" class="formNuevoAnimal formEditarAnimal formEliminarAnimal">

            <div class="form-group row">
                <label for="cedDueno" class="col-sm-2 col-form-label">Céd. Dueño:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="cedDueno" name="cedDueno"  disabled>
                </div>
                <div class="col-sm-6">
                    <span id="nombreDueno"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="codAnimal" class="col-sm-2 col-form-label">Código:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="codAnimal" name="codAnimal" style="text-transform: uppercase;" required>
                </div>
                <div class="col-sm-6">
                    <span id="existeAnimal"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="nomAnimal" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomAnimal" name="nomAnimal" style="text-transform: uppercase;" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="fNacimiento" class="col-sm-2 col-form-label">F. nacimiento:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="fNacimiento" name="fNacimiento" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="raza" class="col-sm-2 col-form-label">Raza:</label>
                <div class="col-sm-10">

                    <select id="raza" name="raza" class="form-control" required>

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="genero" class="col-sm-2 col-form-label">Genero:</label>
                <div class="col-sm-10">

                    <select id="genero" name="genero" class="form-control" required>

                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary botAnimalCancelar" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary botAnimalSubmit">Guardar</button>
            </div>

        </form>
      </div>

    </div>
  </div>
</div>




<script src="view/public/gijgo/gijgo.min.js"></script>
<script src="view/public/gijgo/messages.es-es.js"></script>

<script>

$(document).ready(function(){

    // Para la tabla de ANIMALES
    if( document.getElementById('dtAnimales') ){
        var tabla = $('#dtAnimales').DataTable({
            "language": {
                "url": "view/public/vendor/datatables/datatableEspanol.json"
            },
            select: {
                style: 'single',
                info: false
            }
        });
    }

    // ======================================================================== \\
        let hoy = new Date();
        let anio  = hoy.getFullYear();
        let mes = hoy.getMonth() + 1 < 10 ? "0" + (hoy.getMonth() + 1) : hoy.getMonth() + 1;
        let dia   = hoy.getDate() < 10 ? "0" + (hoy.getDate()) : hoy.getDate();
        let fechaActual = anio +"-"+ mes +"-"+ dia;

       // ========================= EDITAR ANIMAL ======================== \\
        //------------- Fechas Editar Animal --------------
        // let today;
        // today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#fNacimiento').datepicker({
            format: 'yyyy-mm-dd',
            locale: 'es-es',
            uiLibrary: 'bootstrap4',
            modal: true,
            weekStartDay: 1,
            maxDate: fechaActual
        });

        // =========================== EDITAR ANIMAL =========================== \\
        // ------------------- Modal Editar Animal ------------------- \\
        $("#dtAnimales tbody").on("click",".editarAnimal", function(){
            $("#formAnimal")[0].reset();
            $("#nombreDueno, #existeAnimal").html("");
            let data = tabla.row($(this).parents("tr")).data();

            $("#cedDueno").val(data[0]).attr("disabled","disabled");
            $("#codAnimal").val(data[1]).attr("disabled","disabled");
            $("#nomAnimal").val(data[2]);
            $("#fNacimiento").val(data[3]);
            $("#nomAnimal,#fNacimiento,#raza,#genero,#fNacimiento").removeAttr("disabled").attr("required","required");

            //titulo del modal
            $("#exampleModalLabel").html("Actualizar Animal");
            $(".modal-header").removeClass("bg-danger bg-primary text-white");
            $(".botAnimalSubmit").removeClass("btn-danger").html("Guardar");

            let miRaza = data[4];
            let miGenero = data[5];

            $.post("bin/AnimalFunciones.php",{ funcion:"raza" },(respuesta) => {
                const objRaza = JSON.parse(respuesta);
                let optionRaza = "";
                $.each(objRaza, function(clave, valor) {
                    if(valor.raza_raza == miRaza){
                        optionRaza += '<option value=' + valor.cod_raza + ' selected>' + valor.raza_raza + '</option>';
                    } else {
                        optionRaza += '<option value=' + valor.cod_raza + '>' + valor.raza_raza + '</option>';
                    }
                });
                $("#raza").html(optionRaza);
            });

            $.post("bin/AnimalFunciones.php",{ funcion:"genero" },(respuesta) => {
                const objGenero = JSON.parse(respuesta);
                let optionGenero= "";
                $.each(objGenero, function(clave, valor) {
                    if(valor.gene_genero == miGenero){
                        optionGenero+= '<option value=' + valor.cod_genero + ' selected>' + valor.gene_genero + '</option>';
                    } else {
                        optionGenero+= '<option value=' + valor.cod_genero + '>' + valor.gene_genero + '</option>';
                    }
                });
                $("#genero").html(optionGenero);
            });

            // console.log(data);
        });

        // ----------- Submit Editar Animal ----------- \\
        $(".formEditarAnimal").submit(e=>{
            e.preventDefault();
            let cedDueno = $("#cedDueno").val();
            let codAnimal = $("#codAnimal").val();
            let nomAnimal = $("#nomAnimal").val();
            let fNacimiento = $("#fNacimiento").val();
            let raza = $("#raza").val();
            let genero = $("#genero").val();

            $.post("bin/AnimalFunciones.php",{ funcion: "editarAnimal",cedDueno,codAnimal,nomAnimal,fNacimiento,raza,genero},(respuesta)=>{

            });

            $("#modalAnimal").modal('hide');
            setTimeout(function(){
                window.location.reload();
            },500);

        });



        // =========================== NUEVO ANIMAL =========================== \\
        // ---------- Modal Nuevo Animal ---------- \\
        $("#btnNuevoAnimal").click(function(){
            $("#formAnimal")[0].reset();
            $("#nombreDueno, #existeAnimal").html("");
            $("#cedDueno,#codAnimal,#nomAnimal,#fNacimiento,#raza,#genero,#fNacimiento").removeAttr("disabled").attr("required","required");
            $('#fNacimiento').val(fechaActual);

            //titulo del modal
            $("#exampleModalLabel").html("Ingresar Animal");
            $(".modal-header").removeClass("bg-danger text-white").addClass("bg-primary text-white");
            $(".botAnimalSubmit").removeClass("btn-danger").html("Guardar");

            $.post("bin/AnimalFunciones.php",{ funcion:"raza"},(respuesta) => {
                const objRaza = JSON.parse(respuesta);
                let optionRaza = "";
                $.each(objRaza, function(clave, valor) {
                         optionRaza += '<option value=' + valor.cod_raza + '>' + valor.raza_raza + '</option>';
                });
                $("#raza").html(optionRaza);
            });

            $.post("bin/AnimalFunciones.php",{ funcion:"genero"},(respuesta) => {
                const objGenero = JSON.parse(respuesta);
                let optionGenero= "";
                $.each(objGenero, function(clave, valor) {
                        optionGenero+= '<option value=' + valor.cod_genero + '>' + valor.gene_genero + '</option>';
                });
                $("#genero").html(optionGenero);
            });
        });

        function valiadarBotAnimNuevo(){
            if ( $("#nombreDueno").html().includes('EXISTE') || $("#existeAnimal").html().includes('EXISTE') ) {
                $(".botAnimalSubmit").attr("disabled","disabled");
            }else{
                $(".botAnimalSubmit").removeAttr("disabled");
            }
        }
        // Consultar el nombre del dueño según la cédula
        $("#cedDueno").change(function(){
            let miDueno = $("#cedDueno").val();
            $(this).val(miDueno.trim());

            $.post("bin/AnimalFunciones.php",{ funcion:"consultarDueno", miDueno },(respuesta) => {
                if( respuesta != 'false' ){
                    const objDueno = JSON.parse(respuesta);
                    $("#nombreDueno").html("<div class='alert-success p-2 rounded'>" + objDueno.cli_nombres + " " + objDueno.cli_apellidos + "</div>");
                } else {
                    $("#nombreDueno").html("<div class='alert-danger p-2 rounded'>NO EXISTE EL CLIENTE</div>");
                }
                valiadarBotAnimNuevo();
            });
        });
        // Consultar si ya existe codigo de animal
        $("#codAnimal").change(function(){
            let miAnimal = $("#codAnimal").val();
            $(this).val(miAnimal.trim());
            $.post("bin/AnimalFunciones.php",{ funcion:"consultarAnimal", miAnimal },(respuesta) => {
                if( respuesta != 'false' ){
                    const objAnimal = JSON.parse(respuesta);
                    $("#existeAnimal").html("<div class='alert-danger p-2 rounded'>YA EXISTE EL CODIGO</div>");
                } else {
                    $("#existeAnimal").html("<i class='fas fa-check text-success mt-2'></i>");
                }
                valiadarBotAnimNuevo();
            });

        });
        // Borrar el nombre del dueño y codigo de animal si se da clic en el boton 'Cancelar'
        $(".botAnimalCancelar, .close").click(function(){
            $("#nombreDueno").html("");
            $("#existeAnimal").html("");
        });

        // ----------- Submit Nuevo Animal ----------- \\
        $(".formNuevoAnimal").submit(e=>{
            e.preventDefault();
            let cedDueno = $("#cedDueno").val();
            let codAnimal = $("#codAnimal").val();
            let nomAnimal = $("#nomAnimal").val();
            let fNacimiento = $("#fNacimiento").val();
            let raza = $("#raza").val();
            let genero = $("#genero").val();

            $.post("bin/AnimalFunciones.php",{ funcion: "nuevoAnimal",cedDueno,codAnimal,nomAnimal,fNacimiento,raza,genero},(respuesta)=>{

            });

            $("#modalAnimal").modal('hide');
            setTimeout(function(){
                window.location.reload();
            },500);
        });



        // ========================= ELIMINAR ANIMAL ======================== \\
        // ---------- Modal Eliminar Animal ---------- \\
        $("#dtAnimales tbody").on("click",".eliminarAnimal", function(){
            $("#formAnimal")[0].reset();
            let data = tabla.row($(this).parents("tr")).data();

            $("#cedDueno").val(data[0]).attr("disabled","disabled");
            $("#codAnimal").val(data[1]).attr("disabled","disabled");
            $("#nomAnimal").val(data[2]).attr("disabled","disabled");
            $("#fNacimiento").val(data[3]).attr("disabled","disabled");
            $("#raza").html("<option>"+ data[4] +"</option>").attr("disabled","disabled");
            $("#genero").html("<option>"+ data[5] +"</option>").attr("disabled","disabled");

            //titulo del modal
            $("#exampleModalLabel").html("Elimiar Animal");
            $(".modal-header").addClass("bg-danger text-white");
            $(".botAnimalSubmit").addClass("btn btn-danger").html("Eliminar");


        });

        // ----------- Submit Eliminiar Animal ----------- \\
        $(".formEliminarAnimal").submit(e=>{
            e.preventDefault();
            let accion = $(".botAnimalSubmit").html();

            if( accion == "Eliminar") {
                let confirmado;
                confirmado = confirm("\nESTÁ A PUNTO DE ELIMINAR ESTE ANIMAL . . . PROCEDO?\n");

                if( confirmado == false ){
                    e.preventDefault();
                    return;
                }

                let codAnimal = $("#codAnimal").val();

                $.post("bin/AnimalFunciones.php",{ funcion:"eliminar", codAnimal },(respuesta) => {
                    alert(respuesta);
                });

            }

            $("#modalAnimal").modal('hide');
            setTimeout(function(){
                window.location.reload();
            },3000);

        });



});

</script>
