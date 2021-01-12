<?php        
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT']."/Estacionamiento/barranav.php");    
?>
<!DOCTYPE html>
<html>
    <head>        
        <meta charset="utf-8">
        <title>Estacionamiento</title>    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos.css">

    </head>
    <body>
        <div class="container" style="padding-top:20px; padding-bottom:100px; max-width: 800px;">
            <h2 style="font-family:arial bold">Registrar nuevo cliente</h2>
            <form id="areaRegCliente" autocomplete="off" method="post" action="registroClientes.php">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre del cliente..." name="nombre">
                </div>
                <div class="form-group">
                    <label for="apePaterno">Primer apellido:</label>
                    <input type="text" class="form-control" id="apePaterno" placeholder="Primer apellido..." name="apePaterno">
                </div>
                <div class="form-group">
                    <label for="apeMaterno">Segundo apellido:</label>
                    <input type="text" class="form-control" id="apeMaterno" placeholder="Segundo apellido..." name="apeMaterno">
                </div> 
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" placeholder="Teléfono..." name="telefono">
                </div> 
                <div class="form-group">
                    <label for="email">Correo:</label>
                    <input type="text" class="form-control" id="email" placeholder="Correo electrónico..." name="email">
                </div> 
                <!--
            <h2 style="font-family:arial bold; padding-top: 25px">Datos del auto</h2>
            <div class="form-inline form-group">
                <label for="matricula" style="padding-right:20px">Matricula:</label>
                <input type="text" class="form-control" id="matricula" placeholder="Matricula..." name="matricula" style="width: 40%">                
                <label for="marca" style="padding-right:20px; padding-left:40px">Marca:</label>
                <input type="text" class="form-control" id="marca" placeholder="Marca..." name="marca">
            </div>
            <div class="form-inline form-group">
                <label for="modelo" style="padding-right:20px">Modelo:</label>
                <input type="text" class="form-control" id="modelo" placeholder="Modelo..." name="modelo" style="width: 42%">                
                <label for="color" style="padding-right:20px; padding-left:40px">Color:</label>
                <input type="text" class="form-control" id="color" placeholder="Color..." name="color">
            </div>
            <div class="form-inline form-group">              
                <label for="tamanio" style="padding-right:20px;">Tamaño:</label>
                <select id="tamanio" name="tamanio" class="form-control">
                    <option value="Chico">Chico</option>
                    <option value="Grande">Grande</option>
                </select>
            </div> -->
            <div class="text-center" style="clear:left; padding-top:30px">
              <input type="submit" class="btn btn-md btn-success" value="Guardar cliente"/>        
            </div>    
            </form>
        </div>

            
    </body>
    <script src="scriptClientes.js" type="text/javascript"></script>
</html>