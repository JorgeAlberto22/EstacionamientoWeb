<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="style.css">
    <title>BIENVENIDOS</title>
</head>
    <body>
        <center>
        <ul class="nav justify-content-end bg-dark">
        <li class="nav-link">
            <h2 class="nav-link active white">ESTACIONAMIENTO</h2>
        </li>
    </ul>
    <div class="text-center">
        <h3>Registrar Usuario</h3>       
        <div class="container" style="padding-top:20px; padding-bottom:100px; max-width: 800px;">
            <h4 style="margin-left: -20px">Rellene los datos</h4>
            <form id="areaRegCliente" autocomplete="off" method="post" action="registroUsuarios.php">
                <div class="form-group">
                    <input type="text" class="form-control" id="id" placeholder="Id del usuario..." name="id">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre del usuario..." name="nombre">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="apellidos" placeholder="Primer apellido..." name="apellidos">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="apeMaterno" placeholder="Segundo apellido..." name="apeMaterno">
                </div> 
                <div class="form-group">
                    <input type="text" class="form-control" id="telefono" placeholder="Teléfono..." name="telefono">
                </div> 
                <div class="form-group">
                    <input type="text" class="form-control" id="email" placeholder="Correo electrónico..." name="email">
                </div> 
                <div class="form-group">
                    <input type="password" class="form-control" id="contraseña" placeholder="Contraseña..." name="contraseña">
                </div>
                <div class="form-inline form-group">              
                    <label for="tamanio" style="padding-right:20px;">Tipo de usuario:</label>
                    <select id="tipo" name="tipo" class="form-control" onchange="cambioTipoUsuario()">
                        <option value="conductor">Conductor</option>
                        <option value="admin">Administrador</option>
                        <option value="cajero">Cajero</option>
                        <option value="valet">Valet</option>
                    </select>
                </div>
                
                
                <div class="text-center" style="clear:left; padding-top:30px">
                    <input type="submit" class="btn btn-outline-secondary" value="Registrar"/>
                    <a type="button"href="iniciar_sesion.php" class="btn btn-outline-danger"> Regresar </a>        
                </div>
            </form>
        </div>

            
    </body>

    <?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "estacionamiento";
    $conn = new mysqli($server, $user, $password, $db);
    if($conn->connect_error){
        die("Falló la conexión: ".$conn->connect_error);
    }else{
    }
?>

    
</html>