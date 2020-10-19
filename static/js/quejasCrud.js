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

    
    var quejas = document.getElementById('quejas');

    quejas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/quejas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.quejas.forEach(doc => {

                quejas.innerHTML += `<tr>
                <td>${doc.asunto}</td>
                <td>${doc.nombre}</td>
                <td>${doc.fecha}</td>
				<td>${doc.hora}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarpago(${doc.id_queja})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-comentarios-${doc.id_queja}" onclick="comentarios(${doc.id_queja})" class="btn btn-outline-success"><i class="fa fa-comments fa-3x"></i></button>
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
    
    var quejas = document.getElementById('quejas');

    quejas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/quejas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.quejas.forEach(doc => {

                quejas.innerHTML += `<tr>
                <td>${doc.asunto}</td>
                <td>${doc.nombre}</td>
                <td>${doc.fecha}</td>
				<td>${doc.hora}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarpago(${doc.id_queja})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-comentarios-${doc.id_queja}" onclick="comentarios(${doc.id_queja})" class="btn btn-outline-success"><i class="fa fa-comments fa-3x"></i></button>
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

            $("#btn-confirmar").attr("onclick",`agregarcomentario(${json['queja'][0].id_queja})`);

            document.getElementById('asunto').innerHTML = json['queja'][0].asunto;
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

function borrarqueja(id){
    $.ajax({
        "url" : base_url + "BackEnd/borraqueja",
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
