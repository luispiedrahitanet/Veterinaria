// Call the dataTables jQuery plugin
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
    

    // ========================= EDITAR USUARIO ======================== \\
    // ---------- Modal Editar Usuario ---------- \\
    $("#dtUsuarios tbody").on("click",".editarUsuario", function(){

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

        $.post("bin/UsuarioFunciones.php",{ funcion:"ciudades", miCiudad },(respuesta) => {
            $("#ciudad").html(respuesta);
        });

        $.post("bin/UsuarioFunciones.php",{ funcion:"perfiles", valPerfil },(respuesta) => {
            $("#perfil").html(respuesta);
        });

        // console.log(data);
    });

    // ----------- Submit Editar Usuario ----------- \\
    $(".formEditarUsuario").submit(e=>{
        let cedula = $("#cedula").val();
        let nombres = $("#nombres").val().toUpperCase();
        let apellidos = $("#apellidos").val().toUpperCase();
        let celular = $("#celular").val();
        let email = $("#email").val();
        let direccion = $("#direccion").val();
        let ciudad = $("#ciudad").val();
        let perfil = $("#perfil").val();
        let contrasena = $("#contrasena").val();

        $.post("bin/UsuarioFunciones.php",{ funcion: "editarUsuario",cedula,nombres,apellidos,celular,email,direccion,ciudad,perfil,contrasena },(respuesta)=>{
            
        });

        window.location.reload();
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
        $.post("bin/UsuarioFunciones.php",{ funcion:"ciudades", miCiudad },(respuesta) => {
            $("#ciudad").html(respuesta);
        });

        $.post("bin/UsuarioFunciones.php",{ funcion:"perfiles", miPerfil: "CLIENTE" },(respuesta) => {
            $("#perfil").html(respuesta);
        });
    });
    
    // ----------- Submit Nuevo Usuario ----------- \\
    $(".formNuevoUsuario").submit(e=>{
        let cedula = $("#cedula").val();
        let nombres = $("#nombres").val();
        let apellidos = $("#apellidos").val();
        let celular = $("#celular").val();
        let email = $("#email").val();
        let direccion = $("#direccion").val();
        let ciudad = $("#ciudad").val();
        let perfil = $("#perfil").val();
        let contrasena = $("#contrasena").val();

        $.post("bin/UsuarioFunciones.php",{ funcion:"nuevoUsuario",cedula,nombres,apellidos,celular,email,direccion,ciudad,perfil,contrasena },(respuesta)=>{
            // console.log(respuesta);
        });
        
        $("#modalUsuario").modal('hide');
        window.location.reload();
    });
    // Consultar el nombre del dueño según la cédula
    $("#cedula").change(function(){
        let miUsuario = $("#cedula").val();
        $(this).val(miUsuario.trim());
        $("#existeUsuario").empty();
        $.post("bin/UsuarioFunciones.php",{ funcion:"consultarUsuario", miUsuario },(respuesta) => {

            //console.log(respuesta);
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
        let accion = $(".botUsuarioSubmit").html();
        if( accion == "Eliminar") {
            let confirmado;
            confirmado = confirm("\nESTÁ A PUNTO DE ELIMININAR ESTE USUARIO . . . PROCEDO?\n");

            if( confirmado == false ){
                e.preventDefault();
                return;
            }

            let cedula = $("#cedula").val();
            
            $.post("bin/UsuarioFunciones.php",{ funcion:"eliminar", cedula },(respuesta) => {
                alert(respuesta);
            });

            $("#modalUsuario").modal('hide');
            window.location.reload();
        }
        
    });


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
    // ---------- Modal Editar Animal ---------- \\
    $("#dtAnimales tbody").on("click",".editarAnimal", function(){

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

        $.post("bin/AnimalFunciones.php",{ funcion:"raza", miRaza },(respuesta) => {
            $("#raza").html(respuesta);
        });

        $.post("bin/AnimalFunciones.php",{ funcion:"genero", miGenero },(respuesta) => {
            $("#genero").html(respuesta);
        });

        // console.log(data);
    });

    // ----------- Submit Editar Animal ----------- \\
    $(".formEditarAnimal").submit(e=>{
        let cedDueno = $("#cedDueno").val();
        let codAnimal = $("#codAnimal").val();
        let nomAnimal = $("#nomAnimal").val();
        let fNacimiento = $("#fNacimiento").val();
        let raza = $("#raza").val();
        let genero = $("#genero").val();

        $.post("bin/AnimalFunciones.php",{ funcion: "editarAnimal",cedDueno,codAnimal,nomAnimal,fNacimiento,raza,genero},(respuesta)=>{
            
        });

        $("#modalAnimal").modal('hide');
        window.location.reload();

    });



    // =========================== NUEVO ANIMAL =========================== \\
    // ---------- Modal Nuevo Animal ---------- \\
    $("#btnNuevoAnimal").click(function(){
        $("#formAnimal")[0].reset();
        $("#cedDueno,#codAnimal,#nomAnimal,#fNacimiento,#raza,#genero,#fNacimiento").removeAttr("disabled").attr("required","required");
        $('#fNacimiento').val(fechaActual);
    
        //titulo del modal
        $("#exampleModalLabel").html("Ingresar Animal");
        $(".modal-header").removeClass("bg-danger text-white").addClass("bg-primary text-white");
        $(".botAnimalSubmit").removeClass("btn-danger").html("Guardar");

        $.post("bin/AnimalFunciones.php",{ funcion:"raza", miRaza: "" },(respuesta) => {
            $("#raza").html(respuesta);
        });

        $.post("bin/AnimalFunciones.php",{ funcion:"genero", miGenero: "" },(respuesta) => {
            $("#genero").html(respuesta);
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
            $("#nombreDueno").html(respuesta);
            valiadarBotAnimNuevo()
        });
    });
    // Consultar si ya existe codigo de animal
    $("#codAnimal").change(function(){
        let miAnimal = $("#codAnimal").val();
        $(this).val(miAnimal.trim());
        $.post("bin/AnimalFunciones.php",{ funcion:"consultarAnimal", miAnimal },(respuesta) => {
            $("#existeAnimal").html(respuesta);
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
        
        let cedDueno = $("#cedDueno").val();
        let codAnimal = $("#codAnimal").val();
        let nomAnimal = $("#nomAnimal").val();
        let fNacimiento = $("#fNacimiento").val();
        let raza = $("#raza").val();
        let genero = $("#genero").val();

        $.post("bin/AnimalFunciones.php",{ funcion: "nuevoAnimal",cedDueno,codAnimal,nomAnimal,fNacimiento,raza,genero},(respuesta)=>{
            
        });
        
        $("#modalAnimal").modal('hide');
        window.location.reload();
    });



    // ========================= ELIMINAR ANIMAL ======================== \\
    // ---------- Modal Eliminar Animal ---------- \\
    $("#dtAnimales tbody").on("click",".eliminarAnimal", function(){

        let data = tabla.row($(this).parents("tr")).data();
        
        $("#cedDueno").val(data[0]).attr("disabled","disabled");
        $("#codAnimal").val(data[1]).attr("disabled","disabled");
        $("#nomAnimal").val(data[2]).attr("disabled","disabled");
        $("#fNacimiento").val(data[3]).attr("disabled","disabled");
        $("#raza").val(data[4]).attr("disabled","disabled");
        $("#genero").val(data[5]).attr("disabled","disabled");

        //titulo del modal
        $("#exampleModalLabel").html("Elimiar Animal");
        $(".modal-header").addClass("bg-danger text-white");
        $(".botAnimalSubmit").addClass("btn btn-danger").html("Eliminar");

        let miRaza = data[4];
        let miGenero = data[5];

        $.post("bin/animalFunciones.php",{ funcion:"raza", miRaza },(respuesta) => {
            $("#raza").html(respuesta);
        });
        $.post("bin/AnimalFunciones.php",{ funcion:"genero", miGenero },(respuesta) => {
            $("#genero").html(respuesta);
        });

    });

    // ----------- Submit Eliminiar Animal ----------- \\
    $(".formEliminarAnimal").submit(e=>{
        let accion = $(".botAnimalSubmit").html();

        if( accion == "Eliminar") {
            let confirmado;
            confirmado = confirm("\nESTÁ A PUNTO DE ELIMININAR ESTE ANIMAL . . . PROCEDO?\n");

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
        window.location.reload(); 
        
    });



});
    






