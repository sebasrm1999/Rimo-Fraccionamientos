let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

$(document).ready(function()
{
    subcolonias();
});

function subcolonias(){
    
	var subcolonias = document.getElementById('subcolonia');

    subcolonias.innerHTML= '<option value="0">No</option>';
    
    $.ajax({
        "url" : base_url + "BackEnd/subcolonias",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){
            json.subcolonias.forEach(doc => {
                subcolonias.innerHTML += `<option value="${doc.id_subcolonia}">${doc.nombre}</option>`;
            });
            
        }
    });
}

function registro(){
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let passwordConf = document.getElementById('con-password').value;
    let nombre = document.getElementById('nombre').value;
    let calle = document.getElementById('calle').value;
    let numero = document.getElementById('numero').value;
    let telefono = document.getElementById('telefono').value;
    let politicas = document.getElementById('privacidad').checked;
    let duenio = $('input[name="optradio"]:checked').val();
    var comprobante = document.getElementById('comprobante').files[0];
    var comprobanteLng = document.getElementById('comprobante').value;
    var subcolonia = document.getElementById('subcolonia');
	var valor = subcolonia.options[subcolonia.selectedIndex].value;

    document.getElementById('password-error').innerHTML = '';

    if(comprobanteLng.length > 0 && email != '' && password != '' && nombre != '' && calle != '' && numero != '' && telefono != '' && passwordConf != '' ){
        if(password.length >= 8){
            if(password === passwordConf){
                if(politicas){
                    $.ajax({
                        "url" : base_url + "BackEnd/usuariocorreo",
                        "type" : "post",
                        "data" : {
                            "correo" : email
                        },
                        "dataType" : "json",
                        "success" : function(json3){
    
                            if(json3.resultado){
                                alertas('Correo ya está en uso, favor de utilizar otro...');
                            } else {
                                var formData = new FormData();
                                formData.append('correo', email);
                                formData.append('nombre', nombre);
                                formData.append('contrasenia', password);
                                formData.append('duenio', duenio);
                                formData.append('telefono', telefono);
                                formData.append('subcolonia', valor);
                                formData.append('direccion', `${calle} ${numero}`);
                                formData.append('comprobante', comprobante);
    
                                axios({
                                    method: 'post',
                                    url: `${base_url}BackEnd/nuevousuario`,
                                    headers: { 'Content-Type': 'multipart/form-data' },
                                    data: formData,
                                }).then(json2 => {
                                    console.log(json2);
                                    if (json2.data.resultado) {
                                        alertaRegistro();
                                    }
                        
                                    else {
                                        alertas(
                                            json2.data.mensaje
                                        );
                                    }
                                }).catch(e => {
                                    alertas(
                                        `Error ${e}`
                                    );
                                    console.log(e);
                                });
                            }
                            
                        }
                    });
                } else {
                    alertas('Debe aceptar las políticas de privacidad');
                }     
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

function alertaRegistro(){
    $('#registroModal').modal('show',{backdrop: 'static', keyboard: false});

    $('#btn-registro-modal').click(function(){
		window.location.replace(`${base_url}index.php`);
    });
}