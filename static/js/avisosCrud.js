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

$(document).ready(function()
{

    var userID = sessionStorage.getItem('id');
        if(userID != null){
          cargartabla();
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

    $('#btn-nuevo-aviso').click(function(){
		var visibilidad = $('#form-aviso').css('display');
		if(visibilidad == 'none'){
			$('#form-aviso').css('display', 'block');
		} else {
			$('#form-aviso').css('display', 'none');
        }
        $("#btn-confirmar").attr("onclick","agregaraviso()");
    });
    
    $('#tipo').on('change', function() {
        if(this.value == 2){
            $('#id_usuario_div').css('display', 'block');
        } else {
            $('#id_usuario_div').css('display', 'none');
        }
      });

      $('#id_usuario').on('input', function(e) {
        var idUsuario = document.getElementById('id_usuario').value;
        usuario(idUsuario);
      });

});

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
    var avisos = document.getElementById('avisos');

    avisos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/avisos",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.avisos.forEach(doc => {
                avisos.innerHTML += `<tr>
				<td><button class="btn btn-outline-light text-dark" onclick="aviso(${doc.id_aviso})">${doc.asunto}</button></td>
				<td>${doc.fecha}</td>
                <td>${doc.hora}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borraraviso(${doc.id_aviso})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_aviso}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_aviso})"><i class="fa fa-pencil fa-3x"></i></button>
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
}

function aviso(id){

    $.ajax({
        "url" : base_url + "BackEnd/aviso",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            if(json[0].tipo == 2){
                
                $.ajax({
                    "url" : base_url + "BackEnd/usuario",
                    "type" : "post",
                    "data" : {
                        "id" : json[0].id_usuario
                    },
                    "dataType" : "json",
                    "success" : function(json2){

                        document.getElementById('destinatario').innerHTML = json2[0].nombre;
                        
                    }
                });
            } else {
                document.getElementById('destinatario').innerHTML = 'Todos';
            }

            $('#avisoModal').modal('show');

            document.getElementById('aviso-titulo').innerHTML = json[0].asunto;
            document.getElementById('descripcion').innerHTML = json[0].descripcion;
            
        }
    });
    
}

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function agregaraviso(){
    var tipo = document.getElementById('tipo');
    var valor = tipo.options[tipo.selectedIndex].value;
    var asunto = document.getElementById('asunto').value;
    var descripcion = document.getElementById('aviso_cuerpo').value;
    if(asunto.length > 0 && descripcion.length > 0){
        if(valor == 1){
            $.ajax({
                "url" : base_url + "BackEnd/nuevoaviso",
                "type" : "post",
                "data" : {
                    "tipo" : valor,
                    "asunto" : asunto,
                    "descripcion" : descripcion
                },
                "dataType" : "json",
                "success" : function(json){
        
                    if(json.resultado){
        
                        cargartabla();
                        $('#form-aviso').css('display', 'none');
                        
                    } else {
                        alertas('Error inesperado');
                    }
                    
                }
            });
        } else if(valor == 2){
            var idusu = document.getElementById('id_usuario').value;
            if(!isNaN(idusu)){
                $.ajax({
                    "url" : base_url + "BackEnd/nuevoaviso",
                    "type" : "post",
                    "data" : {
                        "tipo" : valor,
                        "asunto" : asunto,
                        "descripcion" : descripcion,
                        "id_usuario" : idusu
                    },
                    "dataType" : "json",
                    "success" : function(json){
    
                        console.log(json);
            
                        if(json.resultado){
            
                            cargartabla();
                            $('#form-aviso').css('display', 'none');
                            
                        } else {
                            alertas(json.mensaje);
                        }
                        
                    }
                });
            } else {
                alertas('El ID del usuario debe ser numérico');
            }
            
        } 
    } else {
        alertas('Favor de llenar todos los campos...');
    }
}

function actualizarform(id){
    $.ajax({
        "url" : base_url + "BackEnd/aviso",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            var visibilidad = $('#form-aviso').css('display');
            if(visibilidad == 'none'){
                $('#form-aviso').css('display', 'block');
            } else {
                $('#form-aviso').css('display', 'none');
            }
            $("#btn-confirmar").attr("onclick",`actualizaraviso(${id}, ${json[0].status})`);

            console.log(json);

            var tipo = document.getElementById('tipo');
            tipo.value = json[0].tipo;
            document.getElementById('asunto').value = json[0].asunto;
            document.getElementById('aviso_cuerpo').value = json[0].descripcion;

            if(json[0].tipo == 2){
                $('#id_usuario_div').css('display', 'block');
                document.getElementById('id_usuario').value = json[0].id_usuario;
            } else {
                $('#id_usuario_div').css('display', 'none');
            }
            
        }
    });
    
}

function actualizaraviso(id, status){
    var tipo = document.getElementById('tipo');
    var valor = tipo.options[tipo.selectedIndex].value;
    var asunto = document.getElementById('asunto').value;
    var descripcion = document.getElementById('aviso_cuerpo').value;
    if(asunto.length > 0 && descripcion.length > 0){
        if(valor == 1){
            $.ajax({
                "url" : base_url + "BackEnd/actualizaaviso",
                "type" : "post",
                "data" : {
                    "id" : id,
                    "status" : status,
                    "tipo" : valor,
                    "asunto" : asunto,
                    "descripcion" : descripcion
                },
                "dataType" : "json",
                "success" : function(json){
        
                    if(json.resultado){
        
                        cargartabla();
                        $('#form-aviso').css('display', 'none');
                        
                    } else {
                        alert('Error inesperado');
                    }
                    
                }
            });
        } else if(valor == 2){
            var idusu = document.getElementById('id_usuario').value;
            if(!isNaN(idusu)){
                $.ajax({
                    "url" : base_url + "BackEnd/actualizaaviso",
                    "type" : "post",
                    "data" : {
                        "id" : id,
                        "status" : status,
                        "tipo" : valor,
                        "asunto" : asunto,
                        "descripcion" : descripcion,
                        "id_usuario" : idusu
                    },
                    "dataType" : "json",
                    "success" : function(json){
    
                        console.log(json);
            
                        if(json.resultado){
            
                            cargartabla();
                            $('#form-aviso').css('display', 'none');
                            
                        } else {
                            alert(json.mensaje);
                        }
                        
                    }
                });
            } else {
                alert('El ID del usuario debe ser numérico');
            }
            
        } 
    } else {
        alertas('Favor de llenar todos los campos...');
    }
}

function borraraviso(id){
    $.ajax({
        "url" : base_url + "BackEnd/borraaviso",
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

function usuario(id){

    $.ajax({
        "url" : base_url + "BackEnd/usuario",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            document.getElementById('nombre_usuario').value = json[0].nombre;
            
        }
    });
    
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }
