<?php
    $cliente = $_POST["clienteID"];
    $auto = $_POST["autoID"];
    $fecha = $_POST["fecha"];
    $hraEntrada = $_POST["horaEntrada"];
    
    $matricula = $_POST["matricula"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $color = $_POST["color"];
    $tamanio = $_POST["tamanio"];

    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "estacionamiento";
    $conn = new mysqli($server, $user, $password, $db);

    if($auto == ""){
        if(($matricula == "") || ($marca == "") || ($modelo == "") || ($color == "")){
            echo "<script>alert('Error, campos vacíos');
            location.href = 'nuevo_resguardo.php';
            location.href.reload();</script>";
        }else{
            if($conn->connect_error){
                die("Falló la conexión: ".$conn->connect_error);
            }else{
                $sql_sentence = "INSERT INTO vehiculos (id, placas, marca, modelo, color, tamanio, cliente) VALUES (0, '".$matricula."', '".$marca."', '".$modelo."', '".$color."', '".$tamanio."', '".$cliente."')";
                if($conn->query($sql_sentence) === TRUE){
                    $sql_sentence_aux = "SELECT id FROM cajones WHERE situacion = 'Disponible'";
                    $query = $conn->query($sql_sentence_aux);
                    if($query->num_rows > 0){
                        $row = $query->fetch_assoc();
                        $cajon = $row["id"];
                        
                        $sql_sentence_aux = "SELECT max(id) FROM vehiculos";
                        $query = $conn->query($sql_sentence_aux);
                        if($query->num_rows > 0){
                            $row2 = $query->fetch_assoc();
                            $autoID = $row2["max(id)"];

                            $sql_sentence = "INSERT INTO resguardos (id_cajon, id_vehiculo, hora_llegada, hora_salida, pago, fecha, estatus) VALUES ('".$cajon."', '".$autoID."', '".$hraEntrada."', '', '', '".$fecha."', 'Activo')";
                            if($conn->query($sql_sentence) === TRUE){
                                $sql_sentence = "UPDATE cajones SET situacion = 'Ocupado' WHERE id = '".$cajon."'";
                                if($conn->query($sql_sentence) === TRUE){
                                    echo "<script>alert('Registro éxitoso');
                                                    location.href = 'nuevo_resguardo.php';
                                            location.href.reload();</script>";
                                }else{
                                    echo $conn->error;
                                }
                            }else{
                                echo $conn->error;
                            }
                        }
                    }else{
                        echo "<script>alert('Lugares no disponibles');
                                            location.href = 'nuevo_resguardo.php';
                                    location.href.reload();</script>";
                    }
                }else{
                    echo $conn->error;
                }
            }            
        }
    }else{
        if($cliente == ""){
            echo "<script>alert('Campos vacios');
            location.href = 'nuevo_resguardo.php';
            location.href.reload();</script>";
        }else{
            if($conn->connect_error){
                die("Falló la conexión: ".$conn->connect_error);
            }else{
                $sql_sentence_aux = "SELECT id_vehiculo FROM resguardos WHERE id_vehiculo = ".$auto." AND estatus = 'Activo'";
                $query = $conn->query($sql_sentence_aux);
                if($query->num_rows > 0){
                    echo "<script>alert('El auto ya se encuentra en resguardo');
                    location.href = 'nuevo_resguardo.php';
                    location.href.reload();</script>";
                }else{
                    $sql_sentence_aux = "SELECT id FROM cajones WHERE situacion = 'Disponible'";
                    $query = $conn->query($sql_sentence_aux);
                    if($query->num_rows > 0){
                        $row = $query->fetch_assoc();
                        $cajon = $row["id"];
                        $sql_sentence = "INSERT INTO resguardos (id_cajon, id_vehiculo, hora_llegada, hora_salida, pago, fecha, estatus) VALUES ('".$cajon."', '".$auto."', '".$hraEntrada."', '', '', '".$fecha."', 'Activo')";
                        if($conn->query($sql_sentence) === TRUE){
                            $sql_sentence = "UPDATE cajones SET situacion = 'Ocupado' WHERE id = '".$cajon."'";
                                if($conn->query($sql_sentence) === TRUE){
                                    echo "<script>alert('Tu carro ha sido guardado exitosamente.');
                                                    location.href = 'nuevo_resguardo.php';
                                            location.href.reload();</script>";
                                }else{
                                    echo $conn->error;
                                }
                        }else{
                            echo $conn->error;
                        }
                    }else{
                        echo "<script>alert('Lugares no disponibles');
                                            location.href = 'nuevo_resguardo.php';
                                    location.href.reload();</script>";
                    }
                }
            }
        }
    }
    

    /*
        echo "<script>alert('Registro éxitoso, favor de estacionar en el lugar: ".$lugar."');
                      location.href = 'nuevo_parking.php';</script>";
  
        echo "<script>alert('Error, el auto ya se encuentra estacionado');
        location.href = 'nuevo_parking.php';
        location.href.reload();</script>";
        
    */


?>