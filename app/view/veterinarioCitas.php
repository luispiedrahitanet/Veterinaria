<?php
if (!isset($_SESSION["usu_id"])) {
    header('Location: ../login.php');
}

include('bin/Cita.php');

$citas = new Cita();
$datos = $citas->get_citas();

?>


<!-- Inicio del Formulario -->
<!-- Collapsable Card Example -->
<div class="card shadow mb-5">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">ASIGNACIÓN DE CITAS</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
        <div class="card-body">

            <form id="formCita">
                <div class="form-group">
                    <div class="form-row">
                        <label for="cedCliente" class="col-sm-2 col-form-label text-sm-right">Cliente:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="cedCliente" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control bg-gray-100" id="txtCliente" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label for="selCodAnimal" class="col-sm-2 col-form-label text-sm-right">Animal:</label>
                        <div class="col-sm-8">
                            <select id="selCodAnimal" name="selCodAnimal" class="form-control bg-gray-100" disabled required>

                            </select>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label for="codVeterinario" class="col-sm-2 col-form-label text-sm-right">Veterinario:</label>
                        <div class="col-sm-8">
                            <select id="codVeterinario" name="codVeterinario" class="form-control bg-gray-100" disabled required>

                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-row">
                        <label for="observaciones" class="col-sm-2 col-form-label text-sm-right">Observación:</label>
                        <div class="col-sm-8">
                            <input type="text" name="observaciones" id="observaciones" class="form-control bg-gray-100" disabled>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <div class="form-row">
                        <label for="tipoCita" class="col-sm-2 col-form-label text-sm-right">Tipo cita</label>
                        <div class="col-sm-2">
                            <select id="tipoCita" name="tipoCita" class="form-control bg-gray-100" disabled required>

                            </select>
                        </div>

                        <label for="citaFechaHora" class="col-sm-2 col-form-label text-sm-right">Fecha y hora</label>
                        <div class="col-sm-4">
                            <!-- <input type="text" class="form-control bg-gray-100" id="citaFechaHora" disabled required> -->
                            <select id="citaFechaHora" name="citaFechaHora" class="form-control bg-gray-100" disabled required>

                            </select>
                        </div>
                    </div>
                </div>


                <button type="submit" id="botEnviarCita" class="btn btn-primary mt-5" disabled>Asignar Cita</button>
            </form>

        </div>
    </div>
</div>
<!-- Fin del Formulario -->



<!-- Tabla de Citas -->
<div class="table-responsive mb-5">
    <table class="table table-striped table-bordered table-hover row-border" id="dtCitas">

        <thead class="bg-primary text-white">
            <tr class="text-nowrap">
                <th><i class="fas fa-sort"></i> Cod. Cita</th>
                <th><i class="fas fa-sort"></i> Cod. Animal</th>
                <th><i class="fas fa-sort"></i> Nombre</th>
                <th><i class="fas fa-sort"></i> Fecha</th>
                <th><i class="fas fa-sort"></i> Turno</th>
                <th><i class="fas fa-sort"></i> Tipo</th>
                <th><i class="fas fa-sort"></i> Veterinario</th>
                <th><i class="fas fa-sort"></i> Estado</th>
                <th><i class="fas fa-sort"></i> Observación</th>
                <th> Acción </th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($datos as $registro) {
                echo "<tr>";
                echo "<td>" . $registro['cod_cita'] . "</td>";
                echo "<td>" . $registro['cita_cod_animal'] . "</td>";
                echo "<td>" . $registro['anim_nombre'] . " " . $registro['raza_raza'] . "/" . $registro['gene_genero'] . "</td>";
                echo "<td>" . $registro['cita_fecha'] . "</td>";
                echo "<td>" . date('g:i a', strtotime($registro['cita_turno'])) . "</td>";
                echo "<td>" . $registro['tcita_tipo'] . "</td>";
                echo "<td>" . $registro['usu_nombre'] . " " . $registro['usu_apellido'] . "</td>";
                echo "<td>";
                if ($registro['cita_estado'] == "RESERVADA") {
                    echo "<span class='badge badge-pill badge-warning'>";
                } elseif ($registro['cita_estado'] == "ATENDIDA") {
                    echo "<span class='badge badge-pill badge-success'>";
                } elseif ($registro['cita_estado'] == "CANCELADA") {
                    echo "<span class='badge badge-pill badge-danger'>";
                } elseif ($registro['cita_estado'] == "NO_ASISTE") {
                    echo "<span class='badge badge-pill badge-dark'>";
                } else {
                    echo "<span class='badge badge-pill badge-secondary'>";
                }
                echo $registro['cita_estado'] . "</span></td>";
                echo "<td>" . $registro['cita_observaciones'] . "</td>";
                echo "<td class='text-nowrap'> <a href='#'><i class='editarCita fas fa-edit text-primary ml-2' data-toggle='modal' data-target='#datatCita'></i></a>
                    <a href='#'><i class='eliminarCita fas fa-trash-alt text-danger ml-2' data-toggle='modal' data-target='#datatCita'></i></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- fin de la Tabla de Citas -->


<!-- Inicio del Modal Cita Reservada -->
<div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">CITA ASIGNADA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center font-weight-bold">Datos del paciente</h5>
                <div class="row">
                    <label class="col-4">Cod. Animal:</label>
                        <label id="lbCodAnimal" class="col-8"></label>
                    <label class="col-4">Nombre Animal:</label>
                        <label id="lbNomAnimal" class="col-8"></label>
                    <label class="col-4">Raza/Género:</label>
                        <label id="lbRazaGenero" class="col-8"></label>
                </div>
                <hr>
                <h5 class="text-center font-weight-bold">Datos de la cita</h5>
                <div class="row">
                    <label class="col-4">Número:</label>
                            <label id="lbNumeroCita" class="col-8"></label>
                    <label class="col-4">Fecha:</label>
                            <label id="lbFechaCita" class="col-8"></label>
                    <label class="col-4">Hora:</label>
                            <label id="lbHoraCita" class="col-8"></label>
                    <label class="col-4">Modo:</label>
                            <label id="lbModoCita" class="col-8"></label>
                    <label class="col-4">Veterinario:</label>
                            <label id="lbVeteCita" class="col-8"></label>
                    <label class="col-4">Observaciones:</label>
                            <label id="lbObservaCita" class="col-8"></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary bg-gradient-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal Cita Reservada -->



<!-- Inicio del Modal Modificar-Eliminar Cita -->
<div class="modal fade" id="datatCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger text-white">
                <h5 class="modal-title" id="tituloElEdCita"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form class="formEditarCita formEliminarCita">
                <div class="row">

                    <label class="col-4 font-weight-bold">Número:</label>
                        <label id="lbElEdNumeroCita" class="col-8"></label>
                    <label class="col-4 font-weight-bold">Cod. Animal:</label>
                        <label id="lbElEdCodAnimal" class="col-8"></label>
                    <label class="col-4 font-weight-bold">Nombre Animal:</label>
                        <label id="lbElEdNomAnimal" class="col-8"></label>
                    <label class="col-4 font-weight-bold">Fecha:</label>
                        <label id="lbElEdFechaCita" class="col-8"></label>
                    <label class="col-4 font-weight-bold">Hora:</label>
                        <label id="lbElEdHoraCita" class="col-8"></label>
                    <label class="col-4 font-weight-bold">Modo:</label>
                        <label id="lbElEdModoCita" class="col-8"></label>
                    <label class="col-4 font-weight-bold">Veterinario:</label>
                        <label id="lbElEdVeteCita" class="col-8"></label>
                    <label class="col-4 font-weight-bold">Observaciones:</label>
                        <label id="lbElEdObservaCita" class="col-8"></label>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-4 col-form-label font-weight-bold">Estado:</label>
                        <div class="col-8">
                            <select id="optElEdEstadoCita" name="optElEdEstadoCita" class="form-control">

                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary botCitaSubmit"></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin del Modal Modificar-Eliminar Cita -->



<script>
    $(document).ready(function() {
        // Para la tabla de USUARIOS
        if (document.getElementById('dtCitas')) {
            var tabla = $('#dtCitas').DataTable({
                "responsive": true,
                "language": {
                    "url": "view/public/vendor/datatables/datatableEspanol.json"
                }

            });
        }

        $("#codVeterinario").change(function() {
            llenarFechaHora();
        });

        $("#cedCliente").change(function() {
            let miUsuario = $("#cedCliente").val();
            $(this).val(miUsuario.trim());

            $("#txtCliente").removeClass("text-danger");

            $.post("bin/ClienteFunciones.php", {
                funcion: "consultarUsuario",
                miUsuario
            }, (resUsuario) => {
                if (resUsuario == "false") {

                    $("#txtCliente").val("NO EXISTE EL CLIENTE").addClass("text-danger");
                    $("#cedCliente").focus();
                    $("#selCodAnimal, #codVeterinario, #tipoCita, #citaFechaHora, #observaciones").attr("disabled", "disabled").addClass("bg-gray-100").html("");
                    $("#botEnviarCita").attr("disabled", "disabled");

                } else {

                    const objUsuario = JSON.parse(resUsuario);

                    $.post("bin/AnimalFunciones.php", {
                        funcion: "consAnimalDueno",
                        miUsuario
                    }, (resAnimales) => {
                        if (resAnimales == "[]") {
                            alert("\n" + objUsuario.cli_nombres + " " + objUsuario.cli_apellidos + "\nNo tiene animales asignados");
                            $("#cedCliente").focus();
                        } else {
                            const objAnimal = JSON.parse(resAnimales);
                            let optionAnimal = "";
                            $.each(objAnimal, function(clave, valor) {
                                optionAnimal += '<option value=' + valor.cod_animal + '>' + valor.cod_animal + " - " + valor.raza_raza + " / " + valor.gene_genero + " - NOMBRE: " + valor.anim_nombre + '</option>';
                            });
                            $("#selCodAnimal").html(optionAnimal);
                            activarCitas();
                        }

                    });

                    function activarCitas() {

                        $("#txtCliente").val(objUsuario.cli_nombres + " " + objUsuario.cli_apellidos);
                        $("#selCodAnimal").removeAttr("disabled").removeClass("bg-gray-100").focus();
                        $("#codVeterinario, #tipoCita, #citaFechaHora, #observaciones,#botEnviarCita").removeAttr("disabled").removeClass("bg-gray-100");

                        $.post("bin/VeterinarioFunciones.php", {
                            funcion: "consVariosUsuarios",
                            perfil: "VETERINARIO"
                        }, (resVariosUsu) => {
                            const objVariosUsu = JSON.parse(resVariosUsu);
                            let optionUsuario = "";
                            $.each(objVariosUsu, function(clave, valor) {
                                optionUsuario += '<option value=' + valor.ced_veterinario + '>' + valor.usu_nombre + " " + valor.usu_apellido + '</option>';
                            });

                            $("#codVeterinario").html(optionUsuario);

                            llenarFechaHora();

                        });

                        $.post("bin/CitaFunciones.php", {
                            funcion: "tipoCita",
                        }, (resTipoCita) => {
                            const objVariosUsu = JSON.parse(resTipoCita);
                            let optionTipoCita = "";
                            $.each(objVariosUsu, function(clave, valor) {
                                optionTipoCita += '<option value=' + valor.cod_tipo + '>' + valor.tcita_tipo + '</option>';
                            });
                            $("#tipoCita").html(optionTipoCita);
                            $("#tipoCita option[value='PR'").attr("selected", true);

                        });
                    }

                }
                // console.log(respuesta);

            });

        });

        $("#formCita").submit(e => {
            e.preventDefault();
            let cliente = $("#cedCliente").val();
            let animal = $("#selCodAnimal").val();
            let veterinario = $("#codVeterinario").val();
            let tipocita = $("#tipoCita").val();
            let turno = $("#citaFechaHora").val();
            let observaciones = $("#observaciones").val();

            $.post("bin/CitaFunciones.php", {
                funcion: "asignarCita",
                animal,
                tipocita,
                turno,
                observaciones
            }, (respuesta) => {
                if (respuesta == 'OK') {
                    alert("CITA ASIGNADA ");
                    $.post("bin/CitaFunciones.php",{funcion: 'consultaCita',turno},(resAsignada)=>{

                        const objCitaAsignada = JSON.parse(resAsignada);
                        console.log(objCitaAsignada)
                        // datos del paciente
                        $("#lbCodAnimal").html(objCitaAsignada[0].cita_cod_animal);
                        $("#lbNomAnimal").html(objCitaAsignada[0].anim_nombre);
                        $("#lbRazaGenero").html(objCitaAsignada[0].raza_raza + "/" + objCitaAsignada[0].gene_genero);
                        // datos de la cita
                        $("#lbNumeroCita").html(objCitaAsignada[0].cod_cita);
                        $("#lbFechaCita").html(objCitaAsignada[0].tur_fecha);
                        $("#lbHoraCita").html(objCitaAsignada[0].cita_turno);
                        $("#lbModoCita").html(objCitaAsignada[0].tcita_tipo);
                        $("#lbVeteCita").html(objCitaAsignada[0].usu_nombre + " " + objCitaAsignada[0].usu_apellido);
                        $("#lbObservaCita").html(objCitaAsignada[0].cita_observaciones);

                        $('#modalCita').modal()
                    });
                } else {
                    alert('\nESTE TURNO YA HA SIDO RESERVADO \nFAVOR PROGRAMAR LA CITA EN OTRO TURNO');
                }
            });

            setTimeout(function(){
                window.location.reload();
            },500);
        });

        function llenarFechaHora() {
            let codVeterinario = $("#codVeterinario option:selected").val();
            $.post("bin/citaFunciones.php", {
                funcion: "turnoDisponible"
            }, (resultTurnos) => {
                const objTurnos = JSON.parse(resultTurnos);
                let optionTurnos = "";
                $.each(objTurnos, function(clave, valor) {
                    if (valor.tur_cedveterinario == codVeterinario) {
                        optionTurnos += '<option value=' + valor.id_turno + '>' + valor.tur_fecha + "  " + valor.tur_turno + '</option>';
                    }
                });
                $("#citaFechaHora").html(optionTurnos);
            });

        }


        function resetElEdCita(){
            $("#lbElEdNumeroCita, #lbElEdCodAnimal, #lbElEdNomAnimal, #lbElEdRazaGenero, #lbElEdFechaCita, #lbElEdHoraCita, #lbElEdModoCita, #lbElEdVeteCita, #lbElEdObservaCita").html("");
            $("#optElEdEstadoCita, .botCitaSubmit").removeAttr("disabled");
        }



        // ========================= EDITAR CITA ======================== \\
        // ---------- Modal Editar Cita ---------- \\
        $("#dtCitas tbody").on("click",".editarCita", function(){
            resetElEdCita();
            let data = tabla.row($(this).parents("tr")).data();
            let valEstadoCita = $(data[7]).html();
            $("#lbElEdNumeroCita").html(data[0]);
            $("#lbElEdCodAnimal").html(data[1]);
            $("#lbElEdNomAnimal").html(data[2]);
            $("#lbElEdFechaCita").html(data[3]);
            $("#lbElEdHoraCita").html(data[4]);
            $("#lbElEdModoCita").html(data[5]);
            $("#lbElEdVeteCita").html(data[6]);
            $("#lbElEdObservaCita").html(data[8]);

            if (valEstadoCita == "CANCELADA") {
                $("#optElEdEstadoCita, .botCitaSubmit").attr("disabled","disabled");

            }

            //titulo del modal
            $("#tituloElEdCita").html("Cambiar estado a cita");
            $("#datatCita .modal-header").removeClass("bg-gradient-danger text-white").addClass("bg-gradient-primary text-white");
            $(".botCitaSubmit").removeClass("btn-danger bg-gradient-danger").addClass("btn-primary bg-gradient-primary").html("Guardar");

            $.post("bin/CitaFunciones.php", {
                funcion: "estadoCita"
            }, (resTipoCita) => {
                const objTipoCita = JSON.parse(resTipoCita);
                let optionTipoCita = "";

                $.each(objTipoCita, function(clave, valor) {
                    if(valor == valEstadoCita){
                        optionTipoCita += '<option value=' + valor + ' selected>' + valor + '</option>';
                    }else{
                    optionTipoCita += '<option value=' + valor + '>' + valor + '</option>';
                    }
                });
                $("#optElEdEstadoCita").html(optionTipoCita);

            });

        });

        // ----------- Submit Editar Cita ----------- \\
        $(".formEditarCita").submit(e=>{
            e.preventDefault();
            let codCita = $("#lbElEdNumeroCita").html();
            let estadoCita = $("#optElEdEstadoCita").val();


            $.post("bin/CitaFunciones.php",{ funcion: "editarCita",codCita,estadoCita },(respuesta)=>{
                //alert(respuesta);
            });

            $("#datatcita").modal('hide');
            setTimeout(function(){
                window.location.reload();
            },500);
        });


        // ========================= ELIMINAR CITA ======================== \\
        // ---------- Modal Eliminar Cita ---------- \\
        $("#dtCitas tbody").on("click",".eliminarCita", function(){
            resetElEdCita();
            let data = tabla.row($(this).parents("tr")).data();
            $("#lbElEdNumeroCita").html(data[0]);
            $("#lbElEdCodAnimal").html(data[1]);
            $("#lbElEdNomAnimal").html(data[2]);
            $("#lbElEdFechaCita").html(data[3]);
            $("#lbElEdHoraCita").html(data[4]);
            $("#lbElEdModoCita").html(data[5]);
            $("#lbElEdVeteCita").html(data[6]);
            $("#optElEdEstadoCita").html("<option>"+ data[7] +"</option>").attr("disabled","disabled");
            $("#lbElEdObservaCita").html(data[8]);

            //titulo del modal
            $("#tituloElEdCita").html("Eliminar cita");
            $("#datatCita .modal-header").removeClass("bg-gradient-danger text-white").addClass("bg-gradient-danger text-white");
            $(".botCitaSubmit").removeClass("btn-danger bg-gradient-danger").addClass("btn-danger bg-gradient-danger").html("Eliminar");


        });

        // ----------- Submit Eliminar Cita ----------- \\
        $(".formEliminarCita").submit(e=>{
            e.preventDefault();

            let accion = $(".botCitaSubmit").html();

            if( accion == "Eliminar") {
                let confirmado;
                confirmado = confirm("\nESTÁ A PUNTO DE ELIMININAR ESTA CITA . . . PROCEDO?\n");

                if( confirmado == false ){
                    e.preventDefault();
                    return;
                }

                let codCita = $("#lbElEdNumeroCita").html();

                $.post("bin/CitaFunciones.php",{ funcion: "eliminarCita",codCita },(respuesta)=>{

                });

            }

            $("#datatcita").modal('hide');
            setTimeout(function(){
                window.location.reload();
            },3000);
        });

    });
</script>
