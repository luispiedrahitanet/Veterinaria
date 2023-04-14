<?php
    if (!isset($_SESSION["usu_id"])) {
        header('Location: ../login.php');
    }

    include('bin/Veterinario.php');

    $usuarios = new Usuario();
    $datos = $usuarios->get_veterinario();

?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary mb-3 float-left">VETERINARIOS</h6>
        <a type="button" class="btn btn-primary btn-icon-split float-right" id="btnNuevo" data-toggle="modal" data-target="#modalUsuario">
        <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
        <span class="text">Nuevo veterinario</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="w-100 display table table-bordered table-hover row-border shadow-sm rounded" id="dtUsuarios">
                <thead>
                    <tr class="text-nowrap">
                        <th><i class="fas fa-sort"></i> Cédula</th>
                        <th><i class="fas fa-sort"></i> Nombres</th>
                        <th><i class="fas fa-sort"></i> Apellidos</th>
                        <th><i class="fas fa-sort"></i> Celular</th>
                        <th><i class="fas fa-sort"></i> Email</th>
                        <th><i class="fas fa-sort"></i> Dirección</th>
                        <th><i class="fas fa-sort"></i> Ciudad</th>
                        <th><i class="fas fa-sort"></i> Perfil</th>
                        <th> Acción </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-nowrap">
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Celular</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Perfil</th>
                        <th> Acción </th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach($datos as $registro){
                    echo "<tr>";
                    echo "<td>" . $registro['ced_veterinario'] . "</td>";
                    echo "<td>" . $registro['usu_nombre'] . "</td>";
                    echo "<td>" . $registro['usu_apellido'] . "</td>";
                    echo "<td>" . $registro['usu_celular'] . "</td>";
                    echo "<td>" . $registro['usu_email'] . "</td>";
                    echo "<td>" . $registro['usu_direccion'] . "</td>";
                    echo "<td>" . $registro['ciu_ciudad_depto'] . "</td>";
                    echo "<td>";
                    if($registro['usu_tipo'] == "VETERINARIO"){
                        echo "<span class='badge badge-pill badge-primary'>";
                    }elseif($registro['usu_tipo'] == "AUXILIAR"){
                        echo "<span class='badge badge-pill badge-warning'>";
                    }else{
                        echo "<span class='badge badge-pill badge-secondary'>";
                    }
                    echo $registro['usu_tipo'] . "</span></td>";

                    echo "<td class='text-nowrap'> <a href='#'><i class='editarUsuario fas fa-edit text-primary ml-2' data-toggle='modal' data-target='#modalUsuario'></i></a>
                    <a href='#'><i class='eliminarUsuario fas fa-trash-alt text-danger ml-2' data-toggle='modal' data-target='#modalUsuario'></i></a></td>";
                    echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Usuarios -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ml-4 mr-4">
        <form id="formUsuario" class="formNuevoUsuario formEditarUsuario formEliminarUsuario">

            <div class="form-group row">
                <label for="cedula" class="col-sm-2 col-form-label">Cédula:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="cedula" name="cedula" disabled>
                </div>
                <div class="col-sm-6">
                    <span id="existeUsuario"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="nombres" class="col-sm-2 col-form-label">Nombres:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombres" name="nombres" style="text-transform: uppercase;" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="apellidos" class="col-sm-2 col-form-label">Apellidos:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="apellidos" name="apellidos" style="text-transform: uppercase;" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="celular" class="col-sm-2 col-form-label">Celular:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="celular" name="celular" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" style="text-transform: lowercase;" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="direccion" class="col-sm-2 col-form-label">Dirección:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="ciudad" class="col-sm-2 col-form-label">Ciudad:</label>
                <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="ciudad" name="ciudad" required> -->
                    <select id="ciudad" name="ciudad" class="form-control">

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="perfil" class="col-sm-2 col-form-label">Perfil:</label>
                <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="perfil" name="perfil" required> -->
                    <select id="perfil" name="perfil" class="form-control">

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="contrasena" class="col-sm-2 col-form-label">Contraseña: </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contrasena" name="contrasena" style="background:#f5f8fa;" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary botUsuarioCancelar" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary botUsuarioSubmit">Guardar</button>
            </div>

        </form>
      </div>

    </div>
  </div>
</div>




<script>
$(document).ready(function() {

    $("#accordionSidebar > li.nav-item").click(function(){
        $("#accordionSidebar > li.nav-item").removeClass("active");
        $(this).addClass("active");
    });

    // Para la tabla de USUARIOS
    if( document.getElementById('dtUsuarios') ){
        var tabla = $('#dtUsuarios').DataTable({
            "language": {
                "url": "view/public/vendor/datatables/datatableEspanol.json"
            },
            select: {
                style: 'single',
                info: false
            }
        });
    }


    // ========================= EDITAR USUARIO ======================== \\
    // ---------- Modal Editar Usuario ---------- \\
    $("#dtUsuarios tbody").on("click",".editarUsuario", function(){
        $("#formUsuario")[0].reset();
        let data = tabla.row($(this).parents("tr")).data();
        let valPerfil = $(data[7]).html();

        $("#cedula").val(data[0]).attr("disabled","disabled");
        $("#nombres").val(data[1]).removeAttr("disabled");
        $("#apellidos").val(data[2]).removeAttr("disabled");
        $("#celular").val(data[3]).removeAttr("disabled");
        $("#email").val(data[4]).removeAttr("disabled");
        $("#direccion").val(data[5]).removeAttr("disabled");
        $("#ciudad").val(data[6]).removeAttr("disabled");
        $("#perfil option[value='"+ valPerfil +"']").attr("selected",true);
            $("#perfil").removeAttr("disabled");
        $("#contrasena").removeAttr("required").removeAttr("disabled");
        //titulo del modal
        $("#exampleModalLabel").html("Actualizar Usuario");
        $(".modal-header").removeClass("bg-danger bg-primary text-white");
        $(".botUsuarioSubmit").removeClass("btn-danger").html("Guardar");

        let miCiudad = data[6];

        $.post("bin/VeterinarioFunciones.php",{ funcion:"ciudades"},(respuesta) => {

            const objCiudad = JSON.parse(respuesta);
            let optionCiudad = "";
            $.each(objCiudad, function(clave, valor) {
                if(valor.ciu_ciudad_depto == miCiudad){
                    optionCiudad += '<option value=' + valor.cod_ciudad_depto + ' selected>' + valor.ciu_ciudad_depto + '</option>';
                } else {
                    optionCiudad += '<option value=' + valor.cod_ciudad_depto + '>' + valor.ciu_ciudad_depto + '</option>';
                }
            });
            $("#ciudad").html(optionCiudad);
        });

        $.post("bin/VeterinarioFunciones.php",{ funcion:"perfiles",valPerfil},(respuesta) => {
            $("#perfil").html(respuesta);
        });


    });

    // ----------- Submit Editar Usuario ----------- \\
    $(".formEditarUsuario").submit(e=>{
        e.preventDefault();
        let cedula = $("#cedula").val();
        let nombres = $("#nombres").val().toUpperCase();
        let apellidos = $("#apellidos").val().toUpperCase();
        let celular = $("#celular").val();
        let email = $("#email").val();
        let direccion = $("#direccion").val();
        let ciudad = $("#ciudad").val();
        let perfil = $("#perfil").val();
        let contrasena = $("#contrasena").val();

        $.post("bin/VeterinarioFunciones.php",{ funcion: "editarUsuario",cedula,nombres,apellidos,celular,email,direccion,ciudad,perfil,contrasena },(respuesta)=>{

        });

        $("#modalUsuario").modal('hide');
        setTimeout(function(){
            window.location.reload();
        },500);
    });


    // =========================== NUEVO USUARIO =========================== \\
    // ---------- Modal Nuevo Usuario ---------- \\
    $("#btnNuevo").click(function(){
        $("#formUsuario")[0].reset();
        $("#cedula").removeAttr("disabled").attr("required","required");
        $("#perfil option[value='CLIENTE']").attr("selected",true);
        $("#perfil,#cedula,#nombres,#apellidos,#celular,#email,#direccion,#ciudad,#perfil,#contrasena").removeAttr("disabled");
        //titulo del modal
        $("#exampleModalLabel").html("Ingresar Usuario");
        $(".modal-header").removeClass("bg-danger text-white").addClass("bg-primary text-white");
        $(".botUsuarioSubmit").removeClass("btn-danger").html("Guardar");

        let miCiudad = "Bucaramanga - Santander";
        $.post("bin/VeterinarioFunciones.php",{ funcion:"ciudades"},(respuesta) => {
            const objCiudad = JSON.parse(respuesta);
            let optionCiudad = "";
            $.each(objCiudad, function(clave, valor) {
                if(valor.ciu_ciudad_depto == miCiudad){
                    optionCiudad += '<option value=' + valor.cod_ciudad_depto + ' selected>' + valor.ciu_ciudad_depto + '</option>';
                } else {
                    optionCiudad += '<option value=' + valor.cod_ciudad_depto + '>' + valor.ciu_ciudad_depto + '</option>';
                }
            });
            $("#ciudad").html(optionCiudad);
        });

        $.post("bin/VeterinarioFunciones.php",{ funcion:"perfiles", miPerfil: "CLIENTE" },(respuesta) => {
            $("#perfil").html(respuesta);
        });
    });

    // ----------- Submit Nuevo Usuario ----------- \\
    $(".formNuevoUsuario").submit(e=>{
        e.preventDefault();
        let cedula = $("#cedula").val();
        let nombres = $("#nombres").val();
        let apellidos = $("#apellidos").val();
        let celular = $("#celular").val();
        let email = $("#email").val();
        let direccion = $("#direccion").val();
        let ciudad = $("#ciudad").val();
        let perfil = $("#perfil").val();
        let contrasena = $("#contrasena").val();

        $.post("bin/VeterinarioFunciones.php",{ funcion:"nuevoUsuario",cedula,nombres,apellidos,celular,email,direccion,ciudad,perfil,contrasena },(respuesta)=>{

        });

        $("#modalUsuario").modal('hide');
        setTimeout(function(){
            window.location.reload();
        },500);
    });
    // Consultar el nombre del dueño según la cédula
    $("#cedula").change(function(){
        let miUsuario = $("#cedula").val();
        $(this).val(miUsuario.trim());
        $("#existeUsuario").empty();
        $.post("bin/VeterinarioFunciones.php",{ funcion:"consultarUsuario", miUsuario },(respuesta) => {

            if( respuesta != "false" ){
                $("#existeUsuario").html("<div class='alert-danger p-2 rounded'>YA EXISTE EL USUARIO</div>");
                $(".botUsuarioSubmit").attr("disabled","disabled");
            } else {
                $("#existeUsuario").html("<i class='fas fa-check text-success mt-2'></i>");
                $(".botUsuarioSubmit").removeAttr("disabled");
            }

        });
    });
    // Borrar el nombre del dueño y codigo de animal si se da clic en el boton 'Cancelar'
    $(".botUsuarioCancelar, .close").click(function(){
        $("#existeUsuario").html("");
    });

    // ========================= ELIMINAR USUARIO ======================== \\
    // ---------- Modal Eliminar Usuario ---------- \\
    $("#dtUsuarios tbody").on("click",".eliminarUsuario", function(){
        $("#formUsuario")[0].reset();
        let data = tabla.row($(this).parents("tr")).data();
        valCiudad = data[6];
        let valPerfil = $(data[7]).html();

        $("#cedula").val(data[0]).attr("disabled","disabled");
        $("#nombres").val(data[1]).attr("disabled","disabled");
        $("#apellidos").val(data[2]).attr("disabled","disabled");
        $("#celular").val(data[3]).attr("disabled","disabled");
        $("#email").val(data[4]).attr("disabled","disabled");
        $("#direccion").val(data[5]).attr("disabled","disabled");
        $("#ciudad").html("<option value='"+ valCiudad +"'>"+ valCiudad +"</option>").attr("disabled","disabled");
        $("#perfil").html("<option value='"+ valPerfil +"'>"+ valPerfil +"</option>").attr("disabled","disabled");
        $("#contrasena").removeAttr("required").attr("disabled","disabled");
        //titulo del modal
        $("#exampleModalLabel").html("Elimiar Usuario");
        $(".modal-header").addClass("bg-danger text-white");
        $(".botUsuarioSubmit").addClass("btn btn-danger").html("Eliminar");

    });

    // ----------- Submit Eliminiar Usuario ----------- \\
    $(".formEliminarUsuario").submit(e=>{
        e.preventDefault();
        let accion = $(".botUsuarioSubmit").html();
        if( accion == "Eliminar") {
            let confirmado;
            confirmado = confirm("\nESTÁ A PUNTO DE ELIMININAR ESTE USUARIO . . . PROCEDO?\n");

            if( confirmado == false ){
                e.preventDefault();
                return;
            }

            let cedula = $("#cedula").val();

            $.post("bin/VeterinarioFunciones.php",{ funcion:"eliminar", cedula },(respuesta) => {
                alert(respuesta);
            });

            $("#modalUsuario").modal('hide');
            setTimeout(function(){
                window.location.reload();
            },3000);
        }

    });

});
</script>
