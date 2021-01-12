<?php
    $nombre = $_POST["nombre"];
    $primer_apellido = $_POST["apePaterno"];
    $segundo_apellido = $_POST["apeMaterno"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

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
if($conn->connect_error){
    die("Falló la conexión: ".$conn->connect_error);
}else{
    
    $sql_sentence = "INSERT INTO clientes (id, nombre, apellidos, telefono, correo) VALUES (0,'".$nombre."','".$primer_apellido." ".$segundo_apellido."','".$telefono."','".$email."')";    
    if($conn->query($sql_sentence) === TRUE){
        $sql_sentence_aux = "SELECT max(id) FROM clientes";
        $query = $conn->query($sql_sentence_aux);
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $sql_sentence = "INSERT INTO vehiculos (id, placas, marca, modelo, color, tamanio, cliente) VALUES (0, '".$matricula."', '".$marca."', '".$modelo."', '".$color."', '".$tamanio."', '".($row["max(id)"])."')";
                if($conn->query($sql_sentence) === TRUE){
                    echo "<script>alert('Se ha registrado correctamente');
                    location.href = 'nuevo_cliente.php';
                        location.href.reload();</script>";
                }else{
                    echo $conn->error;
                }
            }
        }
    }else{
        echo $conn->error;
    }
}
                 
    
    function getID(){
        $id = 1;
        if ($fh = fopen('registros_clientes.txt', 'r')) {
            while (!feof($fh)) {
                $getId = fgets($fh);
                if($getId != ""){
                    if($id > $getId){
                        return strval($id);
                    }else{
                        fgets($fh);
                        fgets($fh);
                        fgets($fh);
                        fgets($fh);
                        fgets($fh);
                        $id += 1;
                    }
                }
            }
            fclose($fh);
        }
        return strval($id);
    }
?>