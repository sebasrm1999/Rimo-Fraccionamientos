let base_url = 'http://localhost/myhome_ci/';

$(document).ready(function()
{

	area();

	cargarquejas();

      var header = $('.header');

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

	$('#btn-nueva-queja').click(function(){
		var visibilidad = $('#form-queja').css('display');
		if(visibilidad == 'none'){
			$('#form-queja').css('display', 'block');
		} else {
			$('#form-queja').css('display', 'none');
		}
	});
});

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function area(){
    
	var tipos = document.getElementById('tipo');

    tipos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/areas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){
            json.areas.forEach(doc => {
				console.log(doc.id_area);
                tipos.innerHTML += `<option value="${doc.id_area}">${doc.nombre}</option>`;
            });
            
        }
    });
}

function agregarqueja(){
    var asunto = document.getElementById('asunto').value;
	var descripcion = document.getElementById('queja_cuerpo').value;
	var tipo = document.getElementById('tipo');
	var valor = tipo.options[tipo.selectedIndex].value;
	var id = sessionStorage.getItem('id');
	
    $.ajax({
        "url" : base_url + "BackEnd/nuevaqueja",
        "type" : "post",
        "data" : {
            "asunto" : asunto,
			"descripcion" : descripcion,
			"id_area" : valor,
			"id_usuario" : id
        },
        "dataType" : "json",
        "success" : function(json){

            if(json.resultado){

                cargarquejas();
                $('#form-queja').css('display', 'none');
                
            } else {
                alert('Error inesperado');
            }
            
        }
	});
    
}

function cargarquejas(){
    
	var quejas = document.getElementById('quejas');
	var id = sessionStorage.getItem('id');

    quejas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/quejaxusuario",
        "type" : "post",
        "data" : {
            "id_usuario" : id
        },
        "dataType" : "json",
        "success" : function(json){

            json.quejas.forEach(doc => {
				var status = '';
				if(doc.status == 1){
					status = 'Entregado'
				} else if(doc.status == 2){
					status = 'Leído'
				} else if(doc.status == 3){
					status = 'Contestado'
				}
                quejas.innerHTML += `<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center rounded mt-4">

				<div class="mb-4 mb-md-0 mr-5">
		
					<div class=" d-flex align-items-center">
					<h2 class="mr-3 text-black h3">${doc.asunto}</h2>
					<div class="badge-wrap">
					<span class="text-white badge py-2 px-3" style="background-color: #adc867;">${status}</span>
					</div>
					</div>
					<div class=" d-block d-md-flex">
					<div class="mr-3">${doc.nombre}</div>
					</div>
				</div>
				<div class="ml-auto d-flex">
				<button class="btn py-2 mr-1 text-white btn-quejas" onclick="comentarios(${doc.id_queja})"><i class="fa fa-comments fa-3x" style="padding-right: 5px;"></i></button>
				</div>
				</div>`;
            });
            
        }
    });
}