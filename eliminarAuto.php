<?php
    $auto = $_POST["eliminarAuto"];

    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "estacionamiento";
    $conn = new mysqli($server, $user, $password, $db);
    if($conn->connect_error){
        die("Falló la conexión: ".$conn->connect_error);
    }else{
        //echo "<script>alert('');</script>";
        $sql_sentence = "SELECT * FROM resguardos WHERE estatus = 'Activo' AND id_vehiculo = ".$auto;
        $query = $conn->query($sql_sentence);
        if($query){
            if($query->num_rows > 0){
                echo "<script>alert('No se puede eliminar el auto si existen resguardos activos');
                    location.href = 'ver_autos.php';
                    location.href.reload();</script>";
            }else{
                $sql_sentence = "DELETE FROM vehiculos WHERE id = ".$auto;
                $query = $conn->query($sql_sentence);
                if($query){
                    echo "<script>alert('Información actualizada éxitosamente');
                    location.href = 'ver_autos.php';
                    location.href.reload();</script>";
                }else{
                    echo $conn->error;
                }
            }            
        }else{
            echo $conn->error;
        }            
    }    
?>