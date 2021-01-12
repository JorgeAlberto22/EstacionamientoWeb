<?php    
    $arreglo = $_POST["datosActualizar"];
    $totalPagado = $_POST["total"];
    $lista = explode(',',$arreglo);  
    $resp = "";

    if(count($lista) == 1){
        echo $resp;
    }else{
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "estacionamiento";
        $conn = new mysqli($server, $user, $password, $db);
        if($conn->connect_error){
            die("Falló la conexión: ".$conn->connect_error);
        }else{
            $sql_sentence = "UPDATE resguardos SET hora_salida = '".$lista[3]."', pago = '".$lista[4]."', estatus = 'Pagado' WHERE id_cajon = ".$lista[0]." AND id_vehiculo = ".$lista[1]." AND estatus = 'Activo'";
            $query = $conn->query($sql_sentence);
            if($query){
                $sql_sentence = "UPDATE cajones SET situacion = 'Disponible' WHERE id = ".$lista[0];
                $query = $conn->query($sql_sentence);
                if($query){
                    $resp = "éxito";
                    echo $resp;
                }else{
                    echo $conn->error;
                }
            }else{
                echo $conn->error;
            }
        }
    }
?>