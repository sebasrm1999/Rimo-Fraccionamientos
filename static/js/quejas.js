let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

$(document).ready(function()
{

	var userID = sessionStorage.getItem('id');
		if(userID != null){
		  cargarquejas();
		  area();
		  showPage();
		} else {
		  sessionStorage.clear();
		  window.location.replace(`${base_url}index.php`);
		}

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
				} else if(doc.status == 4){
					status = 'Cerrado'
				}
                quejas.innerHTML += `<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center rounded mt-4">

				<div class="mb-4 mb-md-0 mr-5">
		
					<div class=" d-flex align-items-center">
					<h2 class="mr-3 text-black h3">${doc.asunto}</h2>
					<div class="badge-wrap">
					<span class="text-white badge py-2 px-3" style="background-color: ${doc.status == 4 ? 'red' : '#adc867;'}">${status}</span>
					</div>
					</div>
					<div class=" d-block d-md-flex">
					<div class="mr-3">${doc.nombre}</div>
					<div class="mr-3">Publicada : ${doc.fecha}</div>
                    <div class="mr-3">Estimado : ${doc.fecha_estimada == null ? '---' : doc.fecha_estimada}</div>
					</div>
				</div>
				<div class="ml-auto d-flex">
				<button class="btn py-2 mr-1 text-white btn-quejas" onclick="comentarios(${doc.id_queja})"><i class="fa fa-comments fa-3x" style="padding-right: 5px;"></i></button>
				</div>
				</div>`;
			});
			
			showPage();
            
        }
    });
}

function agregarcomentario(id){
    var comentario = document.getElementById('new-comentario').value;
    idusuario = sessionStorage.getItem("id");
    
            $.ajax({
                "url" : base_url + "BackEnd/nuevocomentario",
                "type" : "post",
                "data" : {
                    "id_usuario" : idusuario,
                    "texto" : comentario,
                    "id_queja" : id
                },
                "dataType" : "json",
                "success" : function(json){
    
                    console.log(json);
        
                    if(json.resultado){
        
                        comentarios(id);
                        
                    } else {
                        alert('Ha ocurrido un error');
                    }
                    
                }
            });
    
}

function comentarios(id){

    document.getElementById('new-comentario').value = '';
    var comentarios = document.getElementById('comentarios');

    comentarios.innerHTML= '';

    $.ajax({
        "url" : base_url + "BackEnd/comentariosxqueja",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            $('#quejaModal').modal('show');

			$("#btn-confirmar-comentario").attr("onclick",`agregarcomentario(${json['queja'][0].id_queja})`);

            document.getElementById('asunto-queja').innerHTML = json['queja'][0].asunto;
            document.getElementById('user-queja').innerHTML = json['queja'][0].nombre;
            document.getElementById('descripcion').innerHTML = json['queja'][0].descripcion;
            document.getElementById('fecha').innerHTML = json['queja'][0].fecha;
            document.getElementById('hora').innerHTML = json['queja'][0].hora;

            json['comentarios'].forEach(doc => {

                console.log(doc);

                comentarios.innerHTML += `<h5><strong id="user-comment-${doc.id_comentario}">${doc.nombre}</strong></h5>
                <div class="m-3">
                    <p id="desc-comment-${doc.id_comentario}" class="queja-desc shadow">${doc.texto}</p>
                    <div class="row float-right mr-3">
                    <h6 id="fecha-${doc.id_comentario}" class="mx-1" style="color:gray;">${doc.fecha}</h6>
                    <h6 id="hora-${doc.id_comentario}" class="mx-1" style="color:gray;">${doc.hora}</h6>
                </div>
                </div>`;
            });
            
        }
    });
    
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }