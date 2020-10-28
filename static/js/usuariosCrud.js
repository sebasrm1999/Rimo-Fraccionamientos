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
let base_url = 'http://localhost/myhome_ci/';

$(document).ready(function()
{
    
    var usuarios = document.getElementById('usuarios');

    usuarios.innerHTML= '';

    var verificado = 'NO';
    
    $.ajax({
        "url" : base_url + "BackEnd/usuarios",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.usuarios.forEach(doc => {

                if(doc.verificado == 1){
                    verificado = 'SI';
                }
                
                usuarios.innerHTML += `<tr>
                <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                <td>${doc.correo}</td>
                <td>${doc.fecha_registro}</td>
                <td>${verificado}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                </td>
				</tr>`;
            });

            $('#dtBasicExample').DataTable({
                "destroy": true,
                "pagingType": "simple_numbers"
              });
            
        }
    });

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

});

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
    var usuarios = document.getElementById('usuarios');

    usuarios.innerHTML= '';

    var verificado = 'NO';
    
    $.ajax({
        "url" : base_url + "BackEnd/usuarios",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.usuarios.forEach(doc => {

                if(doc.verificado == 1){
                    verificado = 'SI';
                }
                
                usuarios.innerHTML += `<tr>
                <td><button class="btn btn-outline-light text-dark" onclick="usuario(${doc.id_usuario})">${doc.nombre}</button></td>
                <td>${doc.correo}</td>
                <td>${doc.fecha_registro}</td>
                <td>${verificado}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarusuario(${doc.id_usuario})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_usuario}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_usuario})"><i class="fa fa-pencil fa-3x"></i></button>
                </td>
				</tr>`;
            });

            $('#dtBasicExample').DataTable({
                "destroy": true,
                "pagingType": "simple_numbers"
              });
            
        }
    });
}

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
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
            document.getElementById('direccion-usuario').innerHTML = json[0].direccion;
            document.getElementById('telefono-usuario').innerHTML = json[0].telefono;
            document.getElementById('duenio-usuario').innerHTML = json[0].duenio == 1 ? 'Sí' : 'No';
            document.getElementById('verificado-usuario').innerHTML = json[0].verificado == 1 ? 'Sí' : 'No';
            
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
    
                    cargartabla();
                    $('#form-usuario').css('display', 'none');
                    
                } else {
                    alert('Error inesperado');
                }
                
            }
        });
    } else {
        alert('Contraseñas no coinciden.');
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

                cargartabla();
                
            } else {
                alert('Ha ocurrido un error');
            }
            
        }
    });
}