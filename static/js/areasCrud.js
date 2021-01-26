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

    $('#btn-nuevo-area').click(function(){
		var visibilidad = $('#form-area').css('display');
		if(visibilidad == 'none'){
			$('#form-area').css('display', 'block');
		} else {
			$('#form-area').css('display', 'none');
        }
        $("#btn-confirmar").attr("onclick","agregararea()");
    });

});

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
    var areas = document.getElementById('areas');

    areas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/areas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.areas.forEach(doc => {
                areas.innerHTML += `<tr>
                <td>${doc.nombre}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrararea(${doc.id_area})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_area}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_area})"><i class="fa fa-pencil fa-3x"></i></button>
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

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function agregararea(){
    var nombre = document.getElementById('nombre').value;
    if(nombre.length > 0){
        $.ajax({
            "url" : base_url + "BackEnd/nuevaarea",
            "type" : "post",
            "data" : {
                "nombre" : nombre,
                "encargado" : '-'
            },
            "dataType" : "json",
            "success" : function(json){
    
                if(json.resultado){
    
                    cargartabla();
                    $('#form-area').css('display', 'none');
                    
                } else {
                    alertas('Error inesperado');
                }
                
            }
        });
    } else {
        alertas('Favor de llenar todos los campos...');
    }
}

function actualizarform(id){
    $.ajax({
        "url" : base_url + "BackEnd/area",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            var visibilidad = $('#form-area').css('display');
            if(visibilidad == 'none'){
                $('#form-area').css('display', 'block');
            } else {
                $('#form-area').css('display', 'none');
            }
            $("#btn-confirmar").attr("onclick",`actualizararea(${id})`);

            document.getElementById('nombre').value = json[0].nombre;
            
        }
    });
    
}

function actualizararea(id){
    var nombre = document.getElementById('nombre').value;
    if(nombre.length > 0){
        $.ajax({
            "url" : base_url + "BackEnd/actualizaarea",
            "type" : "post",
            "data" : {
                "id" : id,
                "nombre" : nombre,
                "encargado" : '-'
            },
            "dataType" : "json",
            "success" : function(json){
    
                if(json.resultado){
    
                    cargartabla();
                    $('#form-area').css('display', 'none');
                    
                } else {
                    alert('Error inesperado');
                }
                
            }
        });
    } else {
        alertas('Favor de llenar todos los campos...');
    }
}

function borrararea(id){
    $.ajax({
        "url" : base_url + "BackEnd/borraarea",
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

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }