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

    var pagos = document.getElementById('pagos');

    pagos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/pagos",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.pagos.forEach(doc => {

                var pagado = 'No';
                var fecha = '-';
                var hora = '-';

                if(doc.status == 1){
                    pagado = 'SI';
                }
                if(doc.fecha != null){
                    fecha = doc.fecha;
                    hora = doc.hora;
                }

                pagos.innerHTML += `<tr>
                <td><button class="btn btn-outline-light text-dark" >${doc.mes} ${doc.anio}</button></td>
                <td>${doc.nombre}</td>
                <td>${pagado}</td>
                <td>${fecha}</td>
				<td>${hora}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarpago(${doc.id_pago})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_pago}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_pago})"><i class="fa fa-pencil fa-3x"></i></button>
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

    $('#btn-nuevo-pago').click(function(){
		var visibilidad = $('#form-pago').css('display');
		if(visibilidad == 'none'){
			$('#form-pago').css('display', 'block');
		} else {
			$('#form-pago').css('display', 'none');
        }
        $("#btn-confirmar").attr("onclick","agregarpago()");
    });

});

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
    var pagos = document.getElementById('pagos');

    pagos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/pagos",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.pagos.forEach(doc => {

                var pagado = 'No';
                var fecha = '-';
                var hora = '-';

                if(doc.status == 1){
                    pagado = 'SI';
                }
                if(doc.fecha != null){
                    fecha = doc.fecha;
                    hora = doc.hora;
                }

                pagos.innerHTML += `<tr>
                <td><button class="btn btn-outline-light text-dark" >${doc.mes} ${doc.anio}</button></td>
                <td>${doc.nombre}</td>
                <td>${pagado}</td>
                <td>${fecha}</td>
				<td>${hora}</td>
                <td>
                <button class="btn btn-outline-danger" onclick="borrarpago(${doc.id_pago})" ><i class="fa fa-trash fa-3x"></i></button>
                <button id="btn-actualizar-${doc.id_pago}" class="btn btn-outline-warning" onclick="actualizarform(${doc.id_pago})"><i class="fa fa-pencil fa-3x"></i></button>
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

function agregarpago(){
    var idusuario = document.getElementById('id_usuario').value;
    var mes = document.getElementById('mes').value;
    var anio = document.getElementById('anio').value;
    
    if(!isNaN(idusuario)){
        if(!isNaN(anio)){
            $.ajax({
                "url" : base_url + "BackEnd/nuevopago",
                "type" : "post",
                "data" : {
                    "id_usuario" : idusuario,
                    "mes" : mes,
                    "anio" : anio
                },
                "dataType" : "json",
                "success" : function(json){
    
                    console.log(json);
        
                    if(json.resultado){
        
                        cargartabla();
                        $('#form-pago').css('display', 'none');
                        
                    } else {
                        alert(json.mensaje);
                    }
                    
                }
            });
        } else {
            alert('El año ingresado no es un número.');
        }
        
    } else {
        alert('El ID del usuario debe ser numérico');
    }
    
}

function actualizarform(id){
    $.ajax({
        "url" : base_url + "BackEnd/pago",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            var visibilidad = $('#form-pago').css('display');
            if(visibilidad == 'none'){
                $('#form-pago').css('display', 'block');
                $('#act-form').css('display', 'block');
            } else {
                $('#form-pago').css('display', 'none');
                $('#act-form').css('display', 'none');
            }
            $("#btn-confirmar").attr("onclick",`actualizarpago(${id})`);

            console.log(json);

            var status = document.getElementById('status');
            status.value = json[0].status;
            document.getElementById('id_usuario').value = json[0].id_usuario;
            document.getElementById('mes').value = json[0].mes;
            document.getElementById('anio').value = json[0].anio;
            var pronto = document.getElementById('pronto');
            pronto.value = json[0].pronto;
            var tipo = document.getElementById('tipo');
            tipo.value = json[0].tipo;
            
        }
    });
    
}

function actualizarpago(id){
    var tipo = document.getElementById('tipo');
    var valorTipo = tipo.options[tipo.selectedIndex].value;
    var status = document.getElementById('status');
    var valorStatus = status.options[status.selectedIndex].value;
    var pronto = document.getElementById('pronto');
    var valorPronto = pronto.options[pronto.selectedIndex].value;
    var mes = document.getElementById('mes').value;
    var anio = document.getElementById('anio').value;
    var idusu = document.getElementById('id_usuario').value;

    if(valorTipo == "null"){
        valorTipo = null;
    }

    if(valorPronto == "null"){
        valorPronto = null;
    }

        if(!isNaN(idusu)){
            if(!isNaN(anio)){
                $.ajax({
                    "url" : base_url + "BackEnd/actualizapago",
                    "type" : "post",
                    "data" : {
                        "id" : id,
                        "status" : valorStatus,
                        "tipo" : valorTipo,
                        "pronto" : valorPronto,
                        "mes" : mes,
                        "anio" : anio,
                        "id_usuario" : idusu
                    },
                    "dataType" : "json",
                    "success" : function(json){
    
                        console.log(json);
            
                        if(json.resultado){
            
                            cargartabla();
                            $('#form-pago').css('display', 'none');
                            $('#act-form').css('display', 'none');
                            
                        } else {
                            alert(json.mensaje);
                        }
                        
                    }
                });
            } else {
                alert('El año ingresado no es un número.');
            }
            
        } else {
            alert('El ID del usuario debe ser numérico');
        }
}

function borrarpago(id){
    $.ajax({
        "url" : base_url + "BackEnd/borrapago",
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