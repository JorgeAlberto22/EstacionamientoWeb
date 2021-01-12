<?php
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];
    $tipo = $_POST["tipo"];
    
$server = "localhost";
$user = "root";
$password = "";
$db = "estacionamiento";
$conn = new mysqli($server, $user, $password, $db);
if($conn->connect_error){
    die("Falló la conexión: ".$conn->connect_error);
}else{

    $sql_sentence = "SELECT tipo FROM usuarios WHERE id = '".$id."'"; 
    $query = $conn->query($sql_sentence);
    if($query){

        if($query->num_rows > 0){
            echo "<script>alert('Error, usuario no se pudo guardar');</script>";
        }else{
            
            $sql_sentence = "INSERT INTO usuarios (id, nombre, apellidos, telefono, correo, contrasenia, tipo) VALUES ('".$id."','".$nombre."','".$apellidos."','".$telefono."','".$email."','".$contraseña."','".$tipo."')";    
            if($conn->query($sql_sentence) === TRUE){
                //Si el usuario es de tipo conductor entonces tambien se debe registrar un vehiculo como minimo
                if($tipo == "conductor"){
                        echo "<script>alert('Usuario guardado correctamente');
                        location.href = 'iniciar_sesion.php';
                        </script>";
                    }else{
                        echo $conn->error;
                    }
                }else{
                    echo "<script>alert('Usuario guardado correctamente');
                        location.href = 'iniciar_sesion.php';
                        </script>";
                }
            }else{
                echo $conn->error;
            }
            
        }
    }else{
        echo $conn->error;
    }
}
          
?>