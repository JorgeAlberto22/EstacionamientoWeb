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
        <form autocomplete="off" action="registroResguardos.php" method=post style="margin-top:40px; padding-bottom:30px; width: 40%; margin-left: 30%; margin-right: 30%; margin-bottom: 5%; border:1px solid #000000;">                        
            <h5 id="fechaParking" style="float: left; margin-left: 15px"><b>Fecha: 07/04/2019</b></h5> 
            <input id="fecha" name="fecha" type=hidden> 
            <h5 id="horaEntradaParking" style="float: right; margin-right: 15px"><b>Hora: 11:24</b></h5>
            <input id="horaEntrada" name="horaEntrada" type=hidden> 
            <center>
                <hr style="height: 2px; background-color: black">
                <h4><b>Estacionamiento Zumpango del rio</b></h4>
            </center>
            <div class="form-group form-inline autocomplete">
                <label for="cliente" style="margin-left: 10%; width: 20%;">Cliente:</label>         
                <input id="clienteID" name="clienteID" type=hidden>  
                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nombre del cliente..." style="width:60%">
            </div>
            <div id="camposAutoReg" class="form-group form-inline autocomplete">              
                <input id="autoID" name="autoID" type=hidden>   
                <label for="auto" style="margin-top: 10px; margin-left: 10%; width: 20%;">Vehiculo:</label>
                <input type="text" class="form-control" id="auto" name="auto" placeholder="Vehiculo del cliente..." style="width:60%" readonly>
            </div>
            <div id="camposAutoNuevo" style="display: none">
              <div class="form-inline form-group">
                  <label for="matricula" style="margin-left: 10%; width: 20%;">Matricula:</label>
                  <input type="text" class="form-control" id="matricula" placeholder="Matricula..." name="matricula" style="width: 60%">                
              </div>
              <div class="form-inline form-group">              
                  <label for="marca" style="margin-left: 10%; width: 20%;">Marca:</label>
                  <input type="text" class="form-control" id="marca" placeholder="Marca..." name="marca" style="width: 60%">
              </div>
              <div class="form-inline form-group">
                  <label for="modelo" style="margin-left: 10%; width: 20%;">Modelo:</label>
                  <input type="text" class="form-control" id="modelo" placeholder="Modelo..." name="modelo" style="width: 60%">     
              </div>
              <div class="form-inline form-group">              
                  <label for="color" style="margin-left: 10%; width: 20%;">Color:</label>
                  <input type="text" class="form-control" id="color" placeholder="Color..." name="color" style="width: 60%">
              </div>
              <div class="form-inline form-group">              
                  <label for="tamanio" style="margin-left: 10%; width: 20%;">Tamaño:</label>
                  <select id="tamanio" name="tamanio" class="form-control" style="width: 60%">
                      <option value="Chico">Chico</option>
                      <option value="Grande">Grande</option>
                  </select>
              </div>
            </div>

            <center>
              <br>
            <!--<input type="button" class="btn" value="Nuevo auto" id="btnNuevoAuto" onclick="mostrarCampos()"> -->
            <input type="button" class="btn" value="Cancelar" id="btnCancelar" style="display: none" onclick="ocultarCampos()">
            <input type="submit" class="btn" value="Estacionar Vehiculo" id="btnGuardar" disabled>
            </center>
        </form>
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
        $clientes = array();
        $vehiculos = array();
        //echo "<script>alert('');</script>";
        $sql_sentence = "SELECT * FROM clientes";
        $query = $conn->query($sql_sentence);
        if($query){
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    array_push($clientes, "'".$row["id"]."'");
                    array_push($clientes, "'".$row["nombre"]."'");
                    array_push($clientes, "'".$row["apellidos"]."'");
                    array_push($clientes, "'".$row["telefono"]."'");
                    array_push($clientes, "'".$row["correo"]."'");
                }            
            }
            
            $sql_sentence = "SELECT * FROM vehiculos";
            $query = $conn->query($sql_sentence);
            if($query){
                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        array_push($vehiculos, "'".$row["id"]."'");
                        array_push($vehiculos, "'".$row["placas"]."'");
                        array_push($vehiculos, "'".$row["marca"]."'");
                        array_push($vehiculos, "'".$row["modelo"]."'");
                        array_push($vehiculos, "'".$row["color"]."'");
                        array_push($vehiculos, "'".$row["tamanio"]."'");
                        array_push($vehiculos, "'".$row["cliente"]."'");
                    }
                }
            }
        }else{
            echo $conn->error;
        }
    }
?>




    
<script type="text/javascript">
        var d = new Date();
        document.getElementById("fechaParking").innerHTML = "Fecha: "+('0'+d.getDate()).slice(-2)+"/"+('0'+(d.getMonth()+1)).slice(-2)+"/"+d.getFullYear();
        document.getElementById("fecha").value = ('0'+d.getDate()).slice(-2)+"/"+('0'+(d.getMonth()+1)).slice(-2)+"/"+d.getFullYear();
        document.getElementById("horaEntradaParking").innerHTML = "Hora: "+('0'+d.getHours()).slice(-2)+":"+('0'+d.getMinutes()).slice(-2)+":"+('0'+d.getSeconds()).slice(-2);
        document.getElementById("horaEntrada").value = ('0'+d.getHours()).slice(-2)+":"+('0'+d.getMinutes()).slice(-2)+":"+('0'+d.getSeconds()).slice(-2);
        var inputName = document.getElementById("cliente");        
        var inputCar = document.getElementById("auto");
        var arregloClientes = new Array();
        var arregloClientesPHP = [<?php echo implode(",",$clientes);?>];
        var arregloAutos = new Array();
        var arregloAutosPHP = [<?php echo implode(",",$vehiculos);?>];
        rellenaAutocompletar();    
        cargaAutocompletar();

        function rellenaAutocompletar(){
            for(i=0; i<arregloClientesPHP.length; i+=5){
                arregloClientes.push(arregloClientesPHP[i+1]+" "+arregloClientesPHP[i+2]);
            }
        }

function cargaAutocompletar(){
  inputName.addEventListener("input", function(e) {
    var a, b, i, val = this.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) { return false;}
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    this.parentNode.appendChild(a);
    /*for each item in the array...*/
    for (i = 0; i < arregloClientes.length; i++) {
      /*check if the item starts with the same letters as the text field value:*/
      if (arregloClientes[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        /*create a DIV element for each matching element:*/
        b = document.createElement("DIV");
        /*make the matching letters bold:*/
        b.innerHTML = "<strong>" + arregloClientes[i].substr(0, val.length) + "</strong>";
        b.innerHTML += arregloClientes[i].substr(val.length);
        /*insert a input field that will hold the current array item's value:*/
        b.innerHTML += "<input type='hidden' value='" + arregloClientes[i] + "'>";
        /*execute a function when someone clicks on the item value (DIV element):*/
        b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inputName.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
        $("#auto").removeAttr("readonly", false);
        for(i=0; i<arregloClientesPHP.length; i+=5){
                if(inputName.value == arregloClientesPHP[i+1]+" "+arregloClientesPHP[i+2]){
                  document.getElementById("clienteID").value = arregloClientesPHP[i];
                  break;
                }
            }
        listarAutos(inputName.value);
            closeAllLists();
        });
        a.appendChild(b);
      }
    }    
});
/*execute a function presses a key on the keyboard:*/
inputName.addEventListener("keydown", function(e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      /*If the arrow DOWN key is pressed,
      increase the currentFocus variable:*/
      currentFocus++;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 38) { //up
      /*If the arrow UP key is pressed,
      decrease the currentFocus variable:*/
      currentFocus--;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 13) {
      /*If the ENTER key is pressed, prevent the form from being submitted,*/
      e.preventDefault();
      if (currentFocus > -1) {
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
        $("#auto").removeAttr("readonly", false);
        listarAutos(inputName.value);
      }
    }
});
function addActive(x) {
  /*a function to classify an item as "active":*/
  if (!x) return false;
  /*start by removing the "active" class on all items:*/
  removeActive(x);
  if (currentFocus >= x.length) currentFocus = 0;
  if (currentFocus < 0) currentFocus = (x.length - 1);
  /*add class "autocomplete-active":*/
  x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
  /*a function to remove the "active" class from all autocomplete items:*/
  for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("autocomplete-active");
  }
}
function closeAllLists(elmnt) {
  /*close all autocomplete lists in the document,
  except the one passed as an argument:*/
  var x = document.getElementsByClassName("autocomplete-items");
  for (var i = 0; i < x.length; i++) {
    if (elmnt != x[i] && elmnt != inputName) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

function listarAutos(cliente){
  var arregloAutos = new Array();
  $("#marca").removeAttr("readonly", false);
  var seleccionado = "";
    for(i=0; i<arregloClientesPHP.length; i+=5){
        if(cliente == arregloClientesPHP[i+1]+" "+arregloClientesPHP[i+2]){
            for(j=0; j<arregloAutosPHP.length; j+=7){
                if(arregloClientesPHP[i] == arregloAutosPHP[j+6]){
                    arregloAutos.push(arregloAutosPHP[j+2]+" "+arregloAutosPHP[j+3]+" "+arregloAutosPHP[j+1]);
                }
            }
        }
    }

    inputCar.addEventListener("input", function(e) {
    var a, b, i, val = this.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) { return false;}
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    this.parentNode.appendChild(a);
    /*for each item in the array...*/
    for (i = 0; i < arregloAutos.length; i++) {
      /*check if the item starts with the same letters as the text field value:*/
      if (arregloAutos[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        /*create a DIV element for each matching element:*/
        b = document.createElement("DIV");
        /*make the matching letters bold:*/
        b.innerHTML = "<strong>" + arregloAutos[i].substr(0, val.length) + "</strong>";
        b.innerHTML += arregloAutos[i].substr(val.length);
        /*insert a input field that will hold the current array item's value:*/
        b.innerHTML += "<input type='hidden' value='" + arregloAutos[i] + "'>";
        /*execute a function when someone clicks on the item value (DIV element):*/
        b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inputCar.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            hacerEditables();
            closeAllLists();
        });
        a.appendChild(b);
      }
    }    
});
/*execute a function presses a key on the keyboard:*/
inputCar.addEventListener("keydown", function(e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      /*If the arrow DOWN key is pressed,
      increase the currentFocus variable:*/
      currentFocus++;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 38) { //up
      /*If the arrow UP key is pressed,
      decrease the currentFocus variable:*/
      currentFocus--;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 13) {
      /*If the ENTER key is pressed, prevent the form from being submitted,*/
      e.preventDefault();
      if (currentFocus > -1) {
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
        hacerEditables();
      }
    }
});
function addActive(x) {
  /*a function to classify an item as "active":*/
  if (!x) return false;
  /*start by removing the "active" class on all items:*/
  removeActive(x);
  if (currentFocus >= x.length) currentFocus = 0;
  if (currentFocus < 0) currentFocus = (x.length - 1);
  /*add class "autocomplete-active":*/
  x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
  /*a function to remove the "active" class from all autocomplete items:*/
  for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("autocomplete-active");
  }
}
function closeAllLists(elmnt) {
  /*close all autocomplete lists in the document,
  except the one passed as an argument:*/
  var x = document.getElementsByClassName("autocomplete-items");
  for (var i = 0; i < x.length; i++) {
    if (elmnt != x[i] && elmnt != inputName) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
}


function hacerEditables(){
  entrada = document.getElementById("auto").value;
  for(i=0; i<arregloAutosPHP.length; i+=7){
        if(entrada == arregloAutosPHP[i+2]+" "+arregloAutosPHP[i+3]+" "+arregloAutosPHP[i+1]){
            document.getElementById("autoID").value = arregloAutosPHP[i];
            break;
        }
    }
  $("#btnGuardar").removeAttr("disabled", false);
}

function mostrarCampos(){
  document.getElementById("camposAutoNuevo").style.display = "block";
  document.getElementById("btnCancelar").style.display = "inline";
  document.getElementById("btnNuevoAuto").style.display = "none";
  document.getElementById("camposAutoReg").style.display = "none";
  document.getElementById("auto").value = "";
  document.getElementById("autoID").value = "";
  document.getElementById("cliente").value = "";
  document.getElementById("clienteID").value = "";
  $("#auto").attr("disabled", true);
  $("#btnGuardar").removeAttr("disabled", false);
}
function ocultarCampos(){
  
  document.getElementById("camposAutoNuevo").style.display = "none";
  document.getElementById("btnCancelar").style.display = "none";
  document.getElementById("btnNuevoAuto").style.display = "inline";
  document.getElementById("camposAutoReg").style.display = "block";
  $("#btnGuardar").attr("disabled", true);
}

    </script>
</html>