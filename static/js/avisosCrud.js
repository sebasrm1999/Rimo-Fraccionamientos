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
	$('#dtBasicExample').DataTable({
		"pagingType": "simple_numbers" // "simple" option for 'Previous' and 'Next' buttons only
	  });
	  $('.dataTables_length').addClass('bs-select');

    "use strict";

    cargartabla();

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
    });
    
    $('#tipo').on('change', function() {
        if(this.value == 2){
            $('#id_usuario_div').css('display', 'block');
        } else {
            $('#id_usuario_div').css('display', 'none');
        }
      });
});

function cargartabla(){
    var avisos = document.getElementById('avisos');

    avisos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/avisos",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.avisos.forEach(doc => {
                avisos.innerHTML += `<tr>
				<td><button class="btn btn-outline-light text-dark" >${doc.asunto}</button></td>
				<td>${doc.fecha}</td>
				<td>${doc.hora}</td>
				</tr>`;
            });
            
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
                    alert('Error inesperado');
                }
                
            }
        });
    } else if(valor == 2){
        var idusu = document.getElementById('id_usuario').value;
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
    
                if(json.resultado){
    
                    cargartabla();
                    $('#form-aviso').css('display', 'none');
                    
                } else {
                    alert('Error inesperado');
                }
                
            }
        });
    } 
    
}

