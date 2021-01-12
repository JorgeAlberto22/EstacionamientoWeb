var formulario = document.getElementById("areaRegCliente");

$(document).ready(function () {
    // Listen to submit event on the <form> itself!
    $('#areaRegCliente').submit(function (e) {    
      nom = document.getElementById("nombre").value;
      primerA = document.getElementById("apePaterno").value;
      segundoA = document.getElementById("apeMaterno").value;
      tel = document.getElementById("telefono").value;
      email = document.getElementById("email").value;
      matricula = document.getElementById("matricula").value;
      marca = document.getElementById("marca").value;
      mod = document.getElementById("modelo").value;
      color = document.getElementById("color").value;
      tam = document.getElementById("tamanio").value;
      if(comprobar(nom, primerA, segundoA, tel, email, matricula, marca, mod, color, tam)){            
        //REGISTRO
        $.post("Estacionamiento/principal.php", {
          nombre: nom,
          apePaterno: primerA,
          apeMaterno: segundoA,
          telefono: tel,
          correo: email,
          matri: matricula,
          modelo: mod,
          col: color,
          tamanio: tam
        }).complete(function() {
          limpiarCampos();     
        });                            
      }else{          
        e.preventDefault();
      }  
    });    
});

function comprobar(nombre, primer_apellido, segundo_apellido, telefono, email, matricula, marca, modelo, color){    
  if((nombre != "")&&(nombre.match(/[(A-ZÁ-Úa-zá-ú)+\s?+]+/) == nombre)){      
      
      if((primer_apellido != "")&&(primer_apellido.match(/[(A-ZÁ-Úa-zá-ú)+\s?+]+/) == primer_apellido)){
        

        if((segundo_apellido != "")&&(segundo_apellido.match(/[(A-ZÁ-Úa-zá-ú)+\s?+]+/) == segundo_apellido)){
                
           
            
        if((telefono != "")&&(telefono.match(/[1-9][0-9]{6,10}/) == telefono)){
                
           
            if((email != "")&&(email.match(/[_A-Za-z0-9-\+]+(\.[_A-Za-z0-9-]+)*@+[A-Za-z0-9-]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})/g) == email)){
              

                if((matricula != "")&&((matricula.match(/[A-Z]{3}\-[0-9]{2}\-[0-9]{2}/) == matricula)||(matricula.match(/[A-Z]\-\d{3}\-[A-Z]{3}/)==matricula) ||(matricula.match(/\d{3}\-[A-Z]{3}/)==matricula)||(matricula.match(/[A-Z]\-\d{2}\-[A-Z]{3}/)==matricula))){
                    
                  if((marca!="")&&marca.match(/[(A-ZÁ-Úa-zá-ú0-9)+\s?+]+/)==marca){

                    if((modelo!="")&&modelo.match(/[(A-ZÁ-Úa-zá-ú0-9)+\s?+]+/)==modelo){

                      if((color!="")&&color.match(/[(A-ZÁ-Úa-zá-ú)+\s?+]+/)==color){
                        return true;
                      }else{ 
                        alert("Error en el color - Campo vacío o formato inválido (Sólo letras y espacios)");
                        return false;
                      }

                    }else{ 
                      alert("Error en el modelo - Campo vacío o formato inválido (Sólo letras, digitos y espacios)");
                      return false;
                    }
                  }else{ 
                    alert("Error en la marca - Campo vacío o formato inválido (Sólo letras, digitos y espacios)");
                    return false;                    
                  }
                }else{               
                    alert("Error en la matricula del auto - Campo vacío o formato inválido \nL = Letra, D = Digito \tFormatos válidos: \n(LLL-DD-DD, L-DDD-LLL, DDD-LLL o bien L-DD-LLL)");
                    return false;
                }
            }else{                
              alert("Error en el email - Campo vacío o formato inválido");
              return false;
            }
    
          }else{          
            alert("Error en el teléfono - Campo vacío o formato inválido (entre 7 y 10 digitos)");
            return false;
          }
    
          }else{          
            alert("Error en el segundo apellido - Campo vacío o formato inválido (Sólo letras)");
            return false;
          }

      }else{          
        alert("Error en el primer apellido - Campo vacío o formato inválido (Sólo letras)");
        return false;
      }
  }else{      
    alert("Error en el nombre - Campo vacío o formato inválido (Sólo letras)");
    return false;
  }
}

function limpiarCampos(){    
    document.getElementById("nombre").value = "";
    document.getElementById("apePaterno").value = "";
    document.getElementById("apeMaterno").value = "";
    document.getElementById("telefono").value = "";
    document.getElementById("email").value = "";
    document.getElementById("matricula").value = "";
    document.getElementById("marca").value = "";
    document.getElementById("modelo").value = "";
    document.getElementById("color").value = "";
}

