<?php
    $id = $_POST["modificarID"];
    $lista = explode(',',$id);  

    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "estacionamiento";
    $conn = new mysqli($server, $user, $password, $db);
    if($conn->connect_error){
        die("Falló la conexión: ".$conn->connect_error);
    }else{
        //echo "<script>alert('');</script>";
        
        for ($x=0;$x<count($lista); $x+=5){
            $sql_sentence = "UPDATE clientes SET nombre = '".$lista[$x+1]."', apellidos = '".$lista[$x+2]."', telefono = '".$lista[$x+3]."', correo = '".$lista[$x+4]."' WHERE id = ".$lista[$x];
            $query = $conn->query($sql_sentence);
            if($query){
                echo "<script>alert('Datos guardados éxitosamente');
                location.href = 'ver_clientes.php';
                location.href.reload();</script>";
            }else{
                echo $conn->error;
            }
        }
    }
    
           
?>