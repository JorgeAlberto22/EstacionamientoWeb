<?php
    $id = $_POST["eliminarID"];
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "estacionamiento";
    $conn = new mysqli($server, $user, $password, $db);
    if($conn->connect_error){
        die("Falló la conexión: ".$conn->connect_error);
    }else{    
        $sql_sentence = "select nombre from clientes inner join vehiculos on clientes.id = cliente inner join resguardos on id_vehiculo = vehiculos.id where resguardos.estatus = 'Activo' and clientes.id = ".$id;
        $query = $conn->query($sql_sentence);
        if($query){
            if($query->num_rows > 0){
                echo "<script>alert('No se puede eliminar el cliente si existen resguardos activos');
                    location.href = 'ver_autos.php';
                    location.href.reload();</script>";
            }else{
                $sql_sentence = "DELETE FROM clientes WHERE id = ".$id;
                $query = $conn->query($sql_sentence);
                if($query){
                    $sql_sentence = "DELETE FROM vehiculos  WHERE cliente = ".$id;
                    $query = $conn->query($sql_sentence);
                    if($query){
                        echo "<script>alert('Información actualizada éxitosamente');
                        location.href = 'ver_clientes.php';
                        location.href.reload();</script>";
                    }else{
                        echo $conn->error;
                    }
                } else{
                    echo $conn->error;
                }
            }
        }else{
            echo $conn->error;
        }
    }

?>