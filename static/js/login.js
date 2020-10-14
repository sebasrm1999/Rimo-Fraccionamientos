let base_url = 'http://localhost/myhome_ci/';

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
                sessionStorage.setItem("id", json.usuario[0].id_usuario);
                sessionStorage.setItem("correo", email);

                window.location.replace(`${base_url}index.php/inicio`);
            } else {
                error.innerHTML = 'Correo o contraseña incorrectos';
            }
            
        }
    });
    
}