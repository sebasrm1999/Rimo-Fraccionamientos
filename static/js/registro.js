let base_url = 'http://localhost/myhome_ci/';

function registro(){
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let passwordConf = document.getElementById('con-password').value;
    let nombre = document.getElementById('nombre').value;
    let calle = document.getElementById('calle').value;
    let numero = document.getElementById('numero').value;
    let telefono = document.getElementById('telefono').value;
    let duenio = $('input[name="optradio"]:checked').val();

    if(email != '' && password != '' && nombre != '' && calle != '' && numero != '' && telefono != '' && passwordConf != '' ){
        if(password.length >= 8){
            if(password === passwordConf){
                $.ajax({
                    "url" : base_url + "BackEnd/nuevousuario",
                    "type" : "post",
                    "data" : {
                        "correo" : email,
                        "contrasenia" : password,
                        "nombre" : nombre,
                        "duenio" : duenio,
                        "telefono" : telefono,
                        "direccion" : `${calle} ${numero}`
                    },
                    "dataType" : "json",
                    "success" : function(json2){
            
                        $.ajax({
                            "url" : base_url + "BackEnd/login",
                            "type" : "post",
                            "data" : {
                                "correo" : email,
                                "contrasenia" : password
                            },
                            "dataType" : "json",
                            "success" : function(json){
                    
                                if(json.resultado){
                    
                                    if(json.usuario[0].tipo == 1){
                                        sessionStorage.setItem("id", json.usuario[0].id_usuario);
                                        sessionStorage.setItem("correo", email);
                    
                                        window.location.replace(`${base_url}index.php/inicio`);
                                    } else if(json.usuario[0].tipo == 2){
                                        sessionStorage.setItem("id", json.usuario[0].id_usuario);
                                        sessionStorage.setItem("correo", email);
                    
                                        window.location.replace(`${base_url}index.php/avisoscrud`);
                                    }
                                    
                                } else {
                                    alertas('Error inesperado!');
                                }
                                
                            }
                        });
                        
                    }
                });
            } else {
                alertas('Las contraseñas no coinciden...');
            }
        } else {
            document.getElementById('password-error').innerHTML = 'La contraseña debe contener al menos 8 caracteres';
        }
    } else {
        alertas('Debe llenar todos los campos...');
    }
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}