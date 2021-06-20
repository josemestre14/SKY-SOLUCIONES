<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8c2f90a4f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>SKY Soluciones Tecnologicas</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">

            <a class="navbar-brand" href="index.html"><img class="img-fluid " src="img/logo sky 2.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link  text-center" href="index.html">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="nosotros.html">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="planes.html">Planes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-center ubicacion" href="contactanos.php">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center " href="test-de-velocidad.html">Test de Velocidad</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <header class=" site-header">
        <div class="contenedor contenido-header">
            <h1>
                <div>CONTACTANOS</div>
            </h1>
        </div>
        <!-- contenedor -->
    </header>
    <!-- contenedor-->


    <h1 class="titulos">Contactanos</h1>


    <main class="container seccion contenido-centrado">
        <h2 class="fw-300 centrar-texto">Llenar el Formulario de Contacto</h2>
        <form action="contactanos.php" method="post">
        
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="Nombre">Nombre y Apellido</label>
                <input type="text" name="Nombre" id="Nombre" placeholder="Nombre y Apellido" required>

                <label for="Telefono">Telefono</label>
                <input type="number" name="Telefono" id="Telefono" placeholder="Telefono" required>

                <legend>Ubicacion</legend>

                <label for="poblacion">Poblacion</label>
                <input type="text" name="poblacion" id="poblacion" placeholder="Poblacion" required>

                <label for="latitud">Latitud</label>
                <input type="" name="latitud" id="latitud" placeholder="Latitud" required>

                <label for="longitud">Longitud</label>
                <input type="" name="longitud" id="longitud" placeholder="Longitud" required>



                <div class="row">
                    <div class="col-md-12">
                        <div id="mapa" style="width: 100%; height: 500px; margin-bottom: 2cm;">

                        </div>
                    </div>
                </div>

                <script>
                    function iniciarMapa() {
                        var latitud = 10.462411647851257;
                        var longitud = -73.25191521435546;

                        coordenas = {
                            lng: longitud,
                            lat: latitud
                        }

                        generarMapa(coordenas);
                    }

                    function generarMapa(coordenadas) {
                        var mapa = new google.maps.Map(document.getElementById("mapa"),

                            {
                                zoom: 12,
                                center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng),
                                mapTypeId: "hybrid",
                            });
                        marcador = new google.maps.Marker({
                            map: mapa,
                            draggable: true,
                            position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
                        });

                        marcador.addListener("dragend", function(event) {
                            document.getElementById("latitud").value = this.getPosition().lat();
                            document.getElementById("longitud").value = this.getPosition().lng();
                        })
                    }
                </script>

                <script src="https://maps.googleapis.com/maps/api/js?Key=AIzaSyC3z4Uzy0HInRhUygMlLCm6T-cJIPbt2K0&callback=iniciarMapa"></script>


            <fieldset>
                <legend>Contacto</legend>


                <label for="atencion">Elije un Horrario,en donde quieres que te llamemos </label>
                <select id="atencion" name="atencion">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="7:00 am - 12:00 m">7:00 am - 12:00 m</option>
                    <option value="2:00 pm - 6:00 pm">2:00 pm - 6:00 pm</option>
                </select>




            </fieldset>
            <input class="button" type="submit" value="Enviar Informacion ">


<?php
error_reporting(0);
$nombre =  $_POST["Nombre"];
$telefono =  $_POST["Telefono"];
$poblacion =  $_POST["poblacion"];
$latitud =  $_POST["latitud"];
$longitud =  $_POST["longitud"];
$atencion =  $_POST["atencion"];

$body = "Nombre del Cliente: $nombre <br>";
$body .= "Telefono: $telefono <br>";
$body .= "Poblacion: $poblacion <br>";
$body .= "Cordenadas: $latitud ,$longitud<br>";
$body .= "A que Hora LLamar: $atencion <br>";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/Exception.php';
require 'php/PHPMailer.php';
require 'php/SMTP.php';

$mail = new PHPMailer(true);

if($_POST)

    try{
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'jmestresaucedo@gmail.com';                     
    $mail->Password   = 'josem199';                               
    $mail->SMTPSecure = "tls";         
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('jmestresaucedo@gmail.com', $nombre);
    $mail->addAddress('jmestresaucedo@gmail.com');    

    //Content
    $mail->isHTML(true);                                
    $mail->Subject = 'Nuevo Cliente';
    $mail->Body    = $body;

$mail->send();
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script> 
    swal({
        title: "Su contacto se envio",
        text: "Un asesor se pondra en contacto con usted",
        icon: "success",
        cancelButtonColor: "#1fb647",
        confirmButtonColor: "#1fb647",
    });</script>';
}catch (Exception $e){
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal({
        title: "Su contacto no se envio",
        text: "Intenta comunicate a este numero de telefono celular +57 313 7571093",
        icon: "warning",
        cancelButtonColor: "#1fb647",
        confirmButtonColor: "#1fb647",
    });</script>';
    }

?>

        </form>
    </main>



    <div class="copyright">

        <p>
            <a href="https://goo.gl/maps/Ju78JZjAvHDH5GHq9"><i class="fas fa-map-marker-alt"><strong>Valledupar,Colombia</strong> </i></a>
            <a href="https://wa.link/o2oyge"><i class="fab fa-whatsapp"><strong>+57 313 7571093</strong></i></a>

            <span> <br> Todos los derechos Reservados SKY SOLUCIONES TECNOLOGICAS S.A.S 2020.<br> DESARROLLADO POR <em>J.D.MESTRE</em></span>
        </p>
    </div>
    <!-- Optional JavaScript -->
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>



</body>

</html>