let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

$(document).ready(function()
{

    validarToken();

});

function validarToken(){
    var token = document.getElementById('token').value;
    var id = document.getElementById('id-url').value;
    $.ajax({
        "url" : base_url + "BackEnd/usuario",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json3){
            if(json3[0].token != token){
                window.location.replace(`${base_url}index.php/invalido`);
                
            } else {
                $("#btn-password").attr("onclick",`actualizarPassword(${id})`);
            }
            
        }
    });
}

function actualizarPassword(id){
    let password = document.getElementById('password').value;
    let passwordConf = document.getElementById('con-password').value;

    if(password.length > 0 & passwordConf.length > 0){
        if(passwordConf == password){
            $.ajax({
                "url" : base_url + "BackEnd/passwordusuario",
                "type" : "post",
                "data" : {
                    "id" : id,
                    "contrasenia" : password,
                },
                "dataType" : "json",
                "success" : function(json){
    
                    if(json.resultado){
                        $.ajax({
                            "url" : base_url + "BackEnd/borrartoken",
                            "type" : "post",
                            "data" : {
                                "id" : id,
                            },
                            "dataType" : "json",
                            "success" : function(json2){
                
                                if(json2.resultado){
                                    $('#aviso-div').css('display', 'block');
                                    $('#correo-div').css('display', 'none');
                                } else {
                                    alertas('Error inesperado');
                                }
                                
                            }
                        });
                    } else {
                        alertas('Error inesperado');
                    }
                    
                }
            });
        } else {
            alertas('Contraseñas no coinciden');
        }
        
    } else {
        alertas('Favor de ingresar los campos.');
    }
    
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}