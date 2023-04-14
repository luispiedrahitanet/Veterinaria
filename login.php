<?php
     $error = "";
if($_POST){
     session_start();
     require('app/bin/Conexion.php');

     $correo = $_POST['email'];
     $contrasena = $_POST['contrasena'];

     $conex = (new Conexion())->conectar();
     $registros = $conex->prepare("SELECT ced_veterinario, usu_nombre, usu_apellido, usu_email, usu_constrasena, usu_tipo FROM veterinario WHERE usu_email=:c AND usu_constrasena=:p");
     $registros->bindParam(":c", $correo);
     $registros->bindParam(":p", $contrasena);
     $registros->execute();
     $resultado = $registros->fetch(PDO::FETCH_ASSOC);

     if ($resultado) {
          $_SESSION['usu_id'] = $resultado['ced_veterinario'];
          $_SESSION['usu_nom'] = $resultado['usu_nombre'];
          $_SESSION['usu_ape'] = $resultado['usu_apellido'];
          $_SESSION['usu_mail'] = $resultado['usu_email'];
          $_SESSION['usu_tipo'] = $resultado['usu_tipo'];
          header('location: app/index.php');
     }else{
          $error = "<div class='alert alert-danger'> Correo y/o Clave inválidos </p>";
     }
}

?>


<!DOCTYPE html>
<html lang="es">
<head>

     <title>Veterinaria Nombre</title>
<!--

Template 2098 Health

http://www.tooplate.com/view/2098-health

-->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
                         <p>Bienvenidos a la Veterinaria Mesavet</p>
                    </div>
                         
                    <div class="col-md-8 col-sm-7 text-align-right">
                         <span class="phone-icon"><i class="fa fa-phone"></i> +57 300 000 00</span>
                         <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 6:00 AM - 06:00 PM (Lun-Sab)</span>
                         <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">info@mesavet.com</a></span>
                    </div>

               </div>
          </div>
     </header>


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <img src="./images/logo.png" alt="" width="40%">
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="/messavet#top" class="smoothScroll">Inicio</a></li>
                         <li><a href="/messavet#about" class="smoothScroll">Acerca de nosotros</a></li>
                         <li><a href="/messavet#team" class="smoothScroll">Veterinarios</a></li>
                         <li><a href="/messavet#news" class="smoothScroll">Trabajos</a></li>
                         <li><a href="/messavet#appointment" class="smoothScroll">Contactanos</a></li>
                    </ul>
               </div>

          </div>
     </section>


     

     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" style="margin-top: -50px;">
          <div class="container">
               <div class="row"  style="display: flex;justify-content:center;">

                    <div class="col-md-6 col-sm-6" style="margin-top:-100px">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment" role="form" method="post" action="login.php">

                              <!-- SECTION TITLE -->
                              <div class="section-title wow fadeInUp text-center" data-wow-delay="0.4s">
                                   <p> <strong> INGRESAR AL CENTRO DE CITAS </strong> </p>
                                   <hr>
                              </div>

                              <div class="col-md-12 col-sm-12" id="infoDev">
                                        <!-- respuesta ajax -->
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.2s">
                                   <div class="col-md-12 col-sm-12" style="padding-top: 5px">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Tu Email" required>
                                   </div>

                                   <div class="col-md-12 col-sm-12">
                                        <label for="contrasena">contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Digita tu contraseña" required>
                                   </div>
                                   
                                   <div class="col-md-12 col-sm-12" style="margin-top: 20px;">
                                        <button type="submit" class="form-control" id="cf-submit" name="submit">Ingresar</button>
                                   </div>
                                   
                                   <?php echo $error; ?>
                              </div>
                        </form>
                    </div>

               </div>
          </div>
     </section>


     <!-- FOOTER -->
     <footer data-stellar-background-ratio="5">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-4">
                         <div class="footer-thumb"> 
                         <h4 class="wow fadeInUp" data-wow-delay="0.4s">Datos de contacto</h4>
                              <p>Proporcionamos el Cuidado que Tu Mascota Necesita. Visítanos para Mayor Información.</p>

                              <div class="contact-info">
                                   <p><i class="fa fa-phone"></i>3056874</p>
                                   <p><i class="fa fa-envelope-o"></i> <a href="#">info@mesavet.com</a></p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4"> 
                         <div class="footer-thumb"> 
                         <h4 class="wow fadeInUp" data-wow-delay="0.4s">Últimas noticias</h4>
                              <div class="latest-stories">
                                   <div class="stories-image">
                                        <a href="#"><img src="images/news-image.jpg" class="img-responsive" alt=""></a>
                                   </div>
                                   <div class="stories-info">
                                        <a href="#"><h5>Vida saludable</h5></a>
                                   </div>
                              </div>

                              <div class="latest-stories">
                                   <div class="stories-image">
                                        <a href="#"><img src="images/news-image.jpg" class="img-responsive" alt=""></a>
                                   </div>
                                   <div class="stories-info">
                                        <a href="#"><h5>Mas sanos y fuertes</h5></a>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4"> 
                         <div class="footer-thumb">
                              <div class="opening-hours">
                              <h4 class="wow fadeInUp" data-wow-delay="0.4s">Horario de Atención</h4>
                                   <p>Lunes - Viernes <span>06:00 AM - 06:00 PM</span></p>
                                   <p>Sabados <span>09:00 AM - 12:00 PM</span></p>
                                   <p>Domingos y festivos  <span>Cerrado</span></p>
                              </div> 

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12 border-top">
                         <div class="col-md-4 col-sm-6">
                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2021 Mesavet  
                                   
                                   | Design: Tooplate</p>
                              </div>
                         </div>
                         <div class="col-md-2 col-sm-2 text-align-center">
                              <div class="angle-up-btn"> 
                                  <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                              </div>
                         </div>   
                    </div>
                    
               </div>
          </div>
     </footer>



     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>