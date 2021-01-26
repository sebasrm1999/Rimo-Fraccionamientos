let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

function mandarCorreo(){
    let error = document.getElementById('email-error');
    let email = document.getElementById('email').value;

    error.innerHTML = '';
    if(email.length > 0){
        $.ajax({
            "url" : base_url + "BackEnd/usuariocorreo",
            "type" : "post",
            "data" : {
                "correo" : email
            },
            "dataType" : "json",
            "success" : function(json3){

                if(json3.resultado){
                    $.ajax({
                        "url" : base_url + "BackEnd/obtenertoken",
                        "type" : "post",
                        "data" : {
                            "id" : json3.usuario[0].id_usuario
                        },
                        "dataType" : "json",
                        "success" : function(json2){
            
                            if(json2.resultado){
                                $('#aviso-div').css('display', 'block');
                                $('#correo-div').css('display', 'none');
                            } else {
                                alertas('Error inesperado al enviar correo');
                            }
                            
                        }
                    });
                } else {
                    alertas('Cuenta inexistente.');
                }
                
            }
        });
    } else {
        alertas('Favor de ingresar su correo.');
    }
    
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}