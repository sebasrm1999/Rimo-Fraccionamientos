let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

function login(){
    let error = document.getElementById('password-error');
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    error.innerHTML = '';
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
                    if(json.usuario[0].verificado == 1){
                        sessionStorage.setItem("id", json.usuario[0].id_usuario);
                        sessionStorage.setItem("correo", email);

                        window.location.replace(`${base_url}index.php/inicio`);
                    } else {
                        alertas('Su cuenta aún no ha sido verificada.');
                    }
                    
                } else if(json.usuario[0].tipo == 2){
                    sessionStorage.setItem("id", json.usuario[0].id_usuario);
                    sessionStorage.setItem("correo", email);

                    window.location.replace(`${base_url}index.php/avisoscrud`);
                } else if(json.usuario[0].tipo == 3){
                    if(json.usuario[0].verificado == 1){
                        sessionStorage.setItem("id", json.usuario[0].id_usuario);
                        sessionStorage.setItem("correo", email);
                        sessionStorage.setItem("area", json.usuario[0].id_area);

                        window.location.replace(`${base_url}index.php/empleados`);
                    } else {
                        alertas('Su cuenta aún no ha sido verificada.');
                    }
                    
                }
                
            } else {
                error.innerHTML = 'Correo o contraseña incorrectos';
            }
            
        }
    });
    
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}