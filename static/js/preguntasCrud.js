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

    var preguntas = document.getElementById('preguntas');

    preguntas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/preguntas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.preguntas.forEach(doc => {
                preguntas.innerHTML += `<tr>
				<td><button class="btn btn-outline-light text-dark" >${doc.asunto}</button></td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarpregunta(${doc.id_pregunta})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_pregunta}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_pregunta})"><i class="fa fa-pencil fa-3x"></i></button>
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

    $('#btn-nueva-pregunta').click(function(){
		var visibilidad = $('#form-pregunta').css('display');
		if(visibilidad == 'none'){
			$('#form-pregunta').css('display', 'block');
		} else {
			$('#form-pregunta').css('display', 'none');
        }
        $("#btn-confirmar").attr("onclick","agregarpregunta()");
    });

});

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
    var preguntas = document.getElementById('preguntas');

    preguntas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/preguntas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.preguntas.forEach(doc => {
                preguntas.innerHTML += `<tr>
				<td><button class="btn btn-outline-light text-dark" >${doc.asunto}</button></td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarpregunta(${doc.id_pregunta})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_pregunta}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_pregunta})"><i class="fa fa-pencil fa-3x"></i></button>
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

function agregarpregunta(){
    var asunto = document.getElementById('asunto').value;
    var descripcion = document.getElementById('pregunta_cuerpo').value;
    $.ajax({
        "url" : base_url + "BackEnd/nuevapregunta",
        "type" : "post",
        "data" : {
            "asunto" : asunto,
            "descripcion" : descripcion
        },
        "dataType" : "json",
        "success" : function(json){

            if(json.resultado){

                cargartabla();
                $('#form-pregunta').css('display', 'none');
                
            } else {
                alert('Error inesperado');
            }
            
        }
    });
    
}

function actualizarform(id){
    $.ajax({
        "url" : base_url + "BackEnd/pregunta",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            var visibilidad = $('#form-pregunta').css('display');
            if(visibilidad == 'none'){
                $('#form-pregunta').css('display', 'block');
            } else {
                $('#form-pregunta').css('display', 'none');
            }
            $("#btn-confirmar").attr("onclick",`actualizarpregunta(${id})`);

            document.getElementById('asunto').value = json[0].asunto;
            document.getElementById('pregunta_cuerpo').value = json[0].descripcion;
            
        }
    });
    
}

function actualizarpregunta(id){
    var asunto = document.getElementById('asunto').value;
    var descripcion = document.getElementById('pregunta_cuerpo').value;
    $.ajax({
        "url" : base_url + "BackEnd/actualizapregunta",
        "type" : "post",
        "data" : {
            "id" : id,
            "asunto" : asunto,
            "descripcion" : descripcion
        },
        "dataType" : "json",
        "success" : function(json){

            if(json.resultado){

                cargartabla();
                $('#form-pregunta').css('display', 'none');
                
            } else {
                alert('Error inesperado');
            }
            
        }
    });
}

function borrarpregunta(id){
    $.ajax({
        "url" : base_url + "BackEnd/borrapregunta",
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