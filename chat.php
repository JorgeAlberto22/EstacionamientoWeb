<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

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


<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyCvYz2atUbJ3R07e_DmNW3Xl4vt7xmtFf4",
    authDomain: "estacionamiento-a5a88.firebaseapp.com",
    projectId: "estacionamiento-a5a88",
    storageBucket: "estacionamiento-a5a88.appspot.com",
    messagingSenderId: "148361933840",
    appId: "1:148361933840:web:adc674aec8ebae4ebb0695"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

    var usuario = prompt("Nombre de usuario: ");

    function sendMessage() {
        // get message
        var mensaje = document.getElementById("message").value;
 
        // save in database
        firebase.database().ref("messages").push().set({
            "sender": usuario,
            "message": mensaje
        });
 
        // prevent form from submitting
        return false;
    }
    
    // listen for incoming messages
    firebase.database().ref("messages").on("child_added", function (snapshot) {
        var html = "";
        // give each message a unique ID
        html += "<li id='message-" + snapshot.key + "'>";
        // show delete button if message is sent by me
        if (snapshot.val().sender == usuario) {
            html += "<button data-id='" + snapshot.key + "' onclick='deleteMessage(this);'>";
                html += "Delete";
            html += "</button>";
        }
        html += snapshot.val().sender + ": " + snapshot.val().message;
        html += "</li>";
 
        document.getElementById("messages").innerHTML += html;
    });

</script>

<!-- create a form to send message -->
<center>
<hr style="height: 2px; background-color: black">
<h4><b>Asistencia Personal</b></h4>
</center>
<form onsubmit="return sendMessage();">
    <input id="message" placeholder="Escriba su mensaje" autocomplete="off">
 
    <input type="submit" value="Enviar" class="btn">
</form>

<!-- create a list -->
<ul id="messages"></ul>