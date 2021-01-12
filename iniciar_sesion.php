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
            <h3>INICIAR SESION</h3>
            <input id="nombreDeUsuario" name="nombreDeUsuario" type="text" placeholder="Usuario" style="width: 25%;"/>
            <br><br>
            <input id="contraseña" name="contraseña" type="text" placeholder="Contraseña" style="width: 25%;"/>
            <br><br>
            <button type="button" class="btn btn-outline-secondary" Onclick="login()">INGRESAR</button>
            <br><br>
            <button type="button" class="btn btn-outline-primary" Onclick="registrar()">Registrarme</button>
        </center>
    </body>
</html>

<?php        
    //Se verifica si ya se ha iniciado sesion como admin, valen, etc. Si es asi, entonces se redirige a la vista del estacionamiento
    session_start();
    if($_SESSION["tipoUsuario"] == "admin" || $_SESSION["tipoUsuario"] == "valet" || $_SESSION["tipoUsuario"] == "cajero"){ 
        echo "<script>location.href='index.php';</script>";
    }else if($_SESSION["tipoUsuario"] == "conductor"){ //Si se inició como conductor entonces se redirige a los datos del conductor
        echo "<script>location.href='index.php';</script>";
    }else{//Si no se ha iniciado sesion se limpian las variables de sesion
        $_SESSION["tipoUsuario"] = "";
        $_SESSION["idUsuario"] = ""; 
    }
?>

<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "estacionamiento";
$conn = new mysqli($server, $user, $password, $db);
if($conn->connect_error){
    die("Falló la conexión: ".$conn->connect_error);
}else{
    $consulta = $conn->query("SELECT * FROM usuarios");
    if($consulta){
        if($consulta->num_rows > 0){
            $usuarios = array();    
            while($fila = $consulta->fetch_assoc()){
                array_push($usuarios, "'".$fila["id"]."'");
                array_push($usuarios, "'".$fila["contrasenia"]."'");
                array_push($usuarios, "'".$fila["tipo"]."'");
            }
        }
    }else{
        echo $conn->error;
    }
}
?>

<script>    
//Se recupera el arreglo de php y se pasa a JavaScript
    var usuarios = [<?php echo implode(",",$usuarios);?>];

    function registrar(){
        location.href="nuevo_usuario.php"
    }


    function login(){
        idUsuario = document.getElementById("nombreDeUsuario").value;
        contraseniaUsuario = document.getElementById("contraseña").value;
        tipoUsuario = "";
        usuarioValido = false;

        for(indice = 0; indice < usuarios.length; indice += 3){
            if(idUsuario == usuarios[indice] && contraseniaUsuario == usuarios[indice+1]){
                tipoUsuario = usuarios[indice+2];
                usuarioValido = true;
                break;
            }
        }

        
        if(usuarioValido){
            $.ajax({
                data: {id: idUsuario, tipo: tipoUsuario},
                url: "iniciarSesion.php",
                type: "POST",            
                success: function(response){
                    if(response.toString() == "conductor"){
                        location.href = "index.php";
                    }else{
                      location.href = "index.php";
                    }
                }
            }).fail(function(e, t, error){
                alert(error.toString());
            });
        }else{
            alert("El usuario o contraseña son incorrectos");
        }
    }
    
</script>