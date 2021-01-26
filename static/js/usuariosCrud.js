/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Menu
4. Init Home Slider
5. Init Google Map
6. Init Testimonials Slider


******************************/
// Basic example
let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

let listaUsuarios = null;

$(document).ready(function()
{

    var userID = sessionStorage.getItem('id');
    if(userID != null){
      cargartabla(0);
      subcolonias();
      area();
      showPage();
    } else {
      sessionStorage.clear();
      window.location.replace(`${base_url}index.php`);
    }

	/* 

	1. Vars and Inits

	*/

	var header = $('.header');
	var map;

	initMenu();

	setHeader();

	

	$(window).on('resize', function()
	{
		setHeader();

		setTimeout(function()
		{
			$(window).trigger('resize.px.parallax');
		}, 375);
	});

	$(document).on('scroll', function()
	{
		setHeader();
	});

	/* 

	2. Set Header

	*/

	function setHeader()
	{
		if($(window).scrollTop() > 91)
		{
			header.addClass('scrolled');
		}
		else
		{
			header.removeClass('scrolled');
		}
	}

	/* 

	3. Init Menu

	*/

	function initMenu()
	{
		if($('.menu').length && $('.hamburger').length)
		{
			var menu = $('.menu');
			var hamburger = $('.hamburger');
			var close = $('.menu_close');
			var superOverlay = $('.super_overlay');

			hamburger.on('click', function()
			{
				menu.toggleClass('active');
				superOverlay.toggleClass('active');
			});

			close.on('click', function()
			{
				menu.toggleClass('active');
				superOverlay.toggleClass('active');
			});

			superOverlay.on('click', function()
			{
				menu.toggleClass('active');
				superOverlay.toggleClass('active');
			});
		}
    }

    $('#tipo').on('change', function() {
        var tipo = document.getElementById('tipo');
        var valorTipo = tipo.options[tipo.selectedIndex].value;
        if(valorTipo == 1){
            $('#duenio-div').css('display', 'block');
            $('#direccion-div').css('display', 'block');
            $('#subcolonia-div').css('display', 'block');
            $('#area-div').css('display', 'none');
        } else if(valorTipo == 3){
            $('#duenio-div').css('display', 'none');
            $('#direccion-div').css('display', 'none');
            $('#subcolonia-div').css('display', 'none');
            $('#area-div').css('display', 'block');
        }
      });

    $('#subcolonias').on('change', function() {
        cargartabla(1);
      });

      $('#duenio-filtro').on('change', function() {
        cargartabla(1);
      });

      $('#verificado-filtro').on('change', function() {
        cargartabla(1);
      });

      $('#btn-nuevo-usuario').click(function(){
        document.getElementById('nombre').value = '';
        document.getElementById('correo').value = '';
        document.getElementById('telefono').value = '';
        document.getElementById('direccion').value = '';
		var visibilidad = $('#form-usuario').css('display');
		if(visibilidad == 'none'){
			$('#form-usuario').css('display', 'block');
		} else {
			$('#form-usuario').css('display', 'none');
        }
        $("#btn-confirmar").attr("onclick","agregarusuario()");
    });

});

function cargartabla(filtro){

    $('#dtBasicExample').DataTable().clear().destroy();
    
    var usuarios = document.getElementById('usuarios');

    usuarios.innerHTML= '';

    var verificado = 'NO';

    if(filtro == 0){
        $.ajax({
            "url" : base_url + "BackEnd/usuarios",
            "type" : "get",
            "dataType" : "json",
            "success" : function(json){

                listaUsuarios = json.usuarios;
    
                json.usuarios.forEach(doc => {
    
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                });
    
                $('#dtBasicExample').DataTable({
                    "destroy": true,
                    "pagingType": "simple_numbers"
                  });
    
                  showPage();
                
            }
        });
    } else if(filtro == 1){
        var subcolonia = document.getElementById('subcolonias');
        var valorSubcolonia = subcolonia.options[subcolonia.selectedIndex].value;
        var duenio = document.getElementById('duenio-filtro');
        var valorDuenio = duenio.options[duenio.selectedIndex].value;
        var verificadoFiltro = document.getElementById('verificado-filtro');
        var valorVerificado = verificadoFiltro.options[verificadoFiltro.selectedIndex].value;
        
        listaUsuarios.forEach(doc => {

            if(valorSubcolonia == 0 && valorDuenio != 3 && valorVerificado != 3){
                if(doc.duenio == valorDuenio && doc.verificado == valorVerificado){
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                } 
                
            } else if(valorSubcolonia != 0 && valorDuenio == 3 && valorVerificado != 3) {
                if(doc.subcolonia == valorSubcolonia && doc.verificado == valorVerificado){
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                }
            } else if(valorSubcolonia != 0 && valorDuenio != 3 && valorVerificado == 3) {
                if(doc.subcolonia == valorSubcolonia && doc.duenio == valorDuenio){
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                }
            } else if(valorSubcolonia != 0 && valorDuenio == 3 && valorVerificado == 3) {
                if(doc.subcolonia == valorSubcolonia){
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                }
            } else if(valorSubcolonia == 0 && valorDuenio != 3 && valorVerificado == 3) {
                if(doc.duenio == valorDuenio){
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                }
            } else if(valorSubcolonia == 0 && valorDuenio == 3 && valorVerificado != 3) {
                if(doc.verificado == valorVerificado){
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                }
            } else if(valorSubcolonia != 0 && valorDuenio != 3 && valorVerificado != 3) {
                if(doc.verificado == valorVerificado && doc.duenio == valorDuenio && doc.subcolonia == valorSubcolonia){
                    if(doc.verificado == 1){
                        verificado = 'SI';
                    } else {
                        verificado = 'NO';
                    }
                    
                    usuarios.innerHTML += `<tr>
                    <td>${doc.id_usuario}</td>
                    <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                    <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                    <td>${doc.correo}</td>
                    <td>${doc.fecha_registro}</td>
                    <td>${doc.fecha_pago}</td>
                    <td>${verificado}</td>
                    <td>
                    <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                    <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                    ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                    <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                    </td>
                    </tr>`;
                }
            } else {
                if(doc.verificado == 1){
                    verificado = 'SI';
                } else {
                    verificado = 'NO';
                }
                
                usuarios.innerHTML += `<tr>
                <td>${doc.id_usuario}</td>
                <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                <td>${doc.tipo == 1 ? 'Inquilino' : 'Encargado'}</td>
                <td>${doc.correo}</td>
                <td>${doc.fecha_registro}</td>
                <td>${doc.fecha_pago}</td>
                <td>${verificado}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                ${doc.comprobante == null ? '' : `<button id="btn-comprobante-${doc.id_usuario}" onclick="descargarComprobante(${doc.id_usuario})" class="btn btn-outline-info"><i class="fa fa-file fa-3x"></i></button>`}
                <button id="btn-verificar-${doc.id_usuario}" class="btn btn-outline-success" onclick="verificar(${doc.id_usuario})"><i class="fa fa-check fa-3x"></i></button>
                </td>
                </tr>`;
            } 
    
            
        });

        $('#dtBasicExample').DataTable({
            "destroy": true,
            "pagingType": "simple_numbers"
          });
    }
    
    
}

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function agregarusuario(){
    var tipo = document.getElementById('tipo');
    var valorTipo = tipo.options[tipo.selectedIndex].value;
    var nombre = document.getElementById('nombre').value;
    var correo = document.getElementById('correo').value;
    var password = document.getElementById('password').value;
    var confPassword = document.getElementById('con-password').value;
    var telefono = document.getElementById('telefono').value;
    var verificado = document.getElementById('verificado');
    var valorVerificado = verificado.options[verificado.selectedIndex].value;

    if(valorTipo == 1){
        var duenio = document.getElementById('duenio');
        var valorDuenio = duenio.options[duenio.selectedIndex].value;
        var direccion = document.getElementById('direccion').value;
        var subcolonia = document.getElementById('subcolonia-input');
        var valorSubcolonia = subcolonia.options[subcolonia.selectedIndex].value;

        if(nombre.length > 0 && correo.length > 0 && password.length > 0 && confPassword.length > 0 && telefono.length > 0 && direccion.length > 0){
            if(validateEmail(correo)){
                if(password.length >= 8){
                    if(password == confPassword){
                        if(!isNaN(telefono) && telefono.length == 10){
                            $.ajax({
                                "url" : base_url + "BackEnd/altausuario",
                                "type" : "post",
                                "data" : {
                                    "nombre" : nombre,
                                    "duenio" : valorDuenio,
                                    "verificado" : valorVerificado,
                                    "tipo" : valorTipo,
                                    "correo" : correo,
                                    "contrasenia" : password,
                                    "telefono" : telefono,
                                    "direccion" : direccion,
                                    "subcolonia" : valorSubcolonia
                                },
                                "dataType" : "json",
                                "success" : function(json){
                        
                                    if(json.resultado){
                        
                                        cargartabla(0);
                                        $('#form-usuario').css('display', 'none');
                                        
                                    } else {
                                        alertas('Error inesperado');
                                    }
                                    
                                }
                            });
                        } else {
                            alertas('El teléfono debe ser numérico y de 10 dígitos');
                        }
                    } else {
                        alertas('Las contraseñas deben coincidir.');
                    }
                } else {
                    alertas('Contraseña debe contener un mínimo de 8 caracteres.');
                }
            } else {
                alertas('Correo inválido.'); 
            }
        } else {
            alertas('Debe llenar todos los campos.');  
        }
    } else if(valorTipo == 3){
        var area = document.getElementById('area');
        var valorArea = area.options[area.selectedIndex].value;

        if(nombre.length > 0 && correo.length > 0 && password.length > 0 && confPassword.length > 0 && telefono.length > 0){
            if(validateEmail(correo)){
                if(password.length >= 8){
                    if(password == confPassword){
                        if(!isNaN(telefono) && telefono.length == 10){
                            $.ajax({
                                "url" : base_url + "BackEnd/altausuario",
                                "type" : "post",
                                "data" : {
                                    "nombre" : nombre,
                                    "verificado" : valorVerificado,
                                    "tipo" : valorTipo,
                                    "correo" : correo,
                                    "contrasenia" : password,
                                    "telefono" : telefono,
                                    "area" : valorArea
                                },
                                "dataType" : "json",
                                "success" : function(json){
                        
                                    if(json.resultado){
                        
                                        cargartabla(0);
                                        $('#form-usuario').css('display', 'none');
                                        
                                    } else {
                                        alertas('Error inesperado');
                                    }
                                    
                                }
                            });
                        } else {
                            alertas('El teléfono debe ser numérico y de 10 dígitos');
                        }
                    } else {
                        alertas('Las contraseñas deben coincidir.');
                    }
                } else {
                    alertas('Contraseña debe contener un mínimo de 8 caracteres.');
                }
            } else {
                alertas('Correo inválido.'); 
            }
        } else {
            alertas('Debe llenar todos los campos.');  
        }
    }
}

function usuario(id){

    $.ajax({
        "url" : base_url + "BackEnd/usuario",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            $('#usuarioModal').modal('show');

            document.getElementById('usuario-titulo').innerHTML = json[0].nombre;
            document.getElementById('correo-usuario').innerHTML = json[0].correo;
            document.getElementById('fecha-usuario').innerHTML = json[0].fecha_registro;
            document.getElementById('fecha-pago-usuario').innerHTML = json[0].fecha_pago;
            document.getElementById('telefono-usuario').innerHTML = json[0].telefono;
            document.getElementById('verificado-usuario').innerHTML = json[0].verificado == 1 ? 'Sí' : 'No';

            if(json[0].tipo == 1){
                document.getElementById('direccion-usuario').innerHTML = json[0].direccion;
                document.getElementById('area-usuario').innerHTML = '----';
                document.getElementById('duenio-usuario').innerHTML = json[0].duenio == 1 ? 'Sí' : 'No';
                if(json[0].subcolonia == null){
                    document.getElementById('subcolonia-usuario').innerHTML = '----';
                } else {
                    $.ajax({
                        "url" : base_url + "BackEnd/subcolonia",
                        "type" : "post",
                        "data" : {
                            "id" : json[0].subcolonia
                        },
                        "dataType" : "json",
                        "success" : function(json2){
                            console.log(json2);
                            document.getElementById('subcolonia-usuario').innerHTML = json2[0].nombre;
                            
                        }
                    });
                }
                
            } else if(json[0].tipo == 3){
                document.getElementById('direccion-usuario').innerHTML = '----';
                document.getElementById('subcolonia-usuario').innerHTML = '----';
                document.getElementById('duenio-usuario').innerHTML = '----';
                $.ajax({
                    "url" : base_url + "BackEnd/area",
                    "type" : "post",
                    "data" : {
                        "id" : json[0].id_area
                    },
                    "dataType" : "json",
                    "success" : function(json2){
            
                        document.getElementById('area-usuario').innerHTML = json2[0].nombre;
                        
                    }
                });
            }
            
        }
    });
    
}

function actualizarform(id){
    $.ajax({
        "url" : base_url + "BackEnd/usuario",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            var visibilidad = $('#form-usuario').css('display');
            if(visibilidad == 'none'){
                $('#form-usuario').css('display', 'block');
            } else {
                $('#form-usuario').css('display', 'none');
            }
            $("#btn-confirmar").attr("onclick",`actualizarusuario(${id})`);

            document.getElementById('nombre').value = json[0].nombre;
            document.getElementById('correo').value = json[0].correo;
            document.getElementById('telefono').value = json[0].telefono;
            document.getElementById('direccion').value = json[0].direccion;
            var verificado = document.getElementById('verificado');
            verificado.value = json[0].verificado;
            var duenio = document.getElementById('duenio');
            duenio.value = json[0].duenio;
            
        }
    });
    
}

function actualizarusuario(id){
    var nombre = document.getElementById('nombre').value;
    var correo = document.getElementById('correo').value;
    var password = document.getElementById('password').value;
    var confPassword = document.getElementById('con-password').value;
    var telefono = document.getElementById('telefono').value;
    var direccion = document.getElementById('direccion').value;
    var verificado = document.getElementById('verificado');
    var valorVerificado = verificado.options[verificado.selectedIndex].value;
    var duenio = document.getElementById('duenio');
    var valorDuenio = duenio.options[duenio.selectedIndex].value;

    if(password == ''){
        password = null;
        confPassword = null;
    }

    if(nombre.length > 0 && correo.length > 0 && telefono.length > 0 && direccion.length > 0){
        if(password != null){
            if(password.length >= 8){
                if(password === confPassword){
                    $.ajax({
                        "url" : base_url + "BackEnd/actualizausuario",
                        "type" : "post",
                        "data" : {
                            "id" : id,
                            "nombre" : nombre,
                            "correo" : correo,
                            "contrasenia" : password,
                            "telefono" : telefono,
                            "direccion" : direccion,
                            "verificado" : valorVerificado,
                            "duenio" : valorDuenio
                        },
                        "dataType" : "json",
                        "success" : function(json){
                
                            if(json.resultado){
                
                                cargartabla(0);
                                $('#form-usuario').css('display', 'none');
                                
                            } else {
                                alertas('El usuario no fue modificado...');
                            }
                            
                        }
                    });
                } else {
                    alertas('Contraseñas no coinciden.');
                }
            } else {
                alertas('La contraseña debe contener mínimo 8 caracteres');
            }
        } else {
            if(password === confPassword){
                $.ajax({
                    "url" : base_url + "BackEnd/actualizausuario",
                    "type" : "post",
                    "data" : {
                        "id" : id,
                        "nombre" : nombre,
                        "correo" : correo,
                        "contrasenia" : password,
                        "telefono" : telefono,
                        "direccion" : direccion,
                        "verificado" : valorVerificado,
                        "duenio" : valorDuenio
                    },
                    "dataType" : "json",
                    "success" : function(json){
            
                        if(json.resultado){
            
                            cargartabla(0);
                            $('#form-usuario').css('display', 'none');
                            
                        } else {
                            alertas('El usuario no fue modificado...');
                        }
                        
                    }
                });
            } else {
                alertas('Contraseñas no coinciden.');
            }
        }
    } else {
        alertas('Favor de llenar todos los campos...');
    }
}

function borrarusuario(id){
    $.ajax({
        "url" : base_url + "BackEnd/borrausuario",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            if(json.resultado){

                cargartabla(0);
                
            } else {
                alertas('Ha ocurrido un error');
            }
            
        }
    });
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}

function descargarComprobante(id){
    $.ajax({
        "url" : base_url + "BackEnd/usuario",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){
            var win = window.open(base_url+'/static/images/comprobantes/'+json[0].comprobante, '_blank');
            win.focus();
        }
    });
}

function verificar(id){
    $.ajax({
        "url" : base_url + "BackEnd/verificarusuario",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){
            if(json.resultado){
                cargartabla(0);
            } else {
                alertas('Error inesperado...');
            }
        }
    });
}

function subcolonias(){
    
	var subcolonias = document.getElementById('subcolonias');

    subcolonias.innerHTML= '<option value="0">---</option>';

    var subcoloniasInput = document.getElementById('subcolonia-input');

    subcoloniasInput.innerHTML= '<option value="0">---</option>';
    
    $.ajax({
        "url" : base_url + "BackEnd/subcolonias",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){
            json.subcolonias.forEach(doc => {
                subcolonias.innerHTML += `<option value="${doc.id_subcolonia}">${doc.nombre}</option>`;
                subcoloniasInput.innerHTML += `<option value="${doc.id_subcolonia}">${doc.nombre}</option>`;
            });
            
        }
    });
}

function area(){
    
	var areas = document.getElementById('area');

    areas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/areas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){
            json.areas.forEach(doc => {
                areas.innerHTML += `<option value="${doc.id_area}">${doc.nombre}</option>`;
            });
            
        }
    });
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }

  function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}