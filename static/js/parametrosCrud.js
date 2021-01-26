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

let editar = false;

$(document).ready(function()
{
    
    var userID = sessionStorage.getItem('id');
        if(userID != null){
          datos();
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

    $('#btn-actualizar').click(function(){
		if(editar){
            $("#pronto").prop('disabled', true);
            $("#costo").prop('disabled', true);
            $("#costo-pronto").prop('disabled', true);
            $("#banco").prop('disabled', true);
            $("#numero").prop('disabled', true);
            $("#clabe").prop('disabled', true);

            $('#btn-confirmar').css('display', 'none');

            editar = false;
		} else {
			$("#pronto").removeAttr('disabled');
            $("#costo").removeAttr('disabled');
            $("#costo-pronto").removeAttr('disabled');
            $("#banco").removeAttr('disabled');
            $("#numero").removeAttr('disabled');
            $("#clabe").removeAttr('disabled');

            $('#btn-confirmar').css('display', 'block');
            editar = true;
        }
    });

});

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function datos(){
    $.ajax({
        "url" : base_url + "BackEnd/datos",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            if(json.resultado){
                document.getElementById('pronto').value = json.datos[0].dias;
                document.getElementById('costo').value = json.datos[0].costo;
                document.getElementById('costo-pronto').value = json.datos[0].costo_pronto;
                document.getElementById('banco').value = json.datos[0].banco;
                document.getElementById('numero').value = json.datos[0].numero;
                document.getElementById('clabe').value = json.datos[0].clabe;

                $("#btn-confirmar").attr("onclick",`actualizardatos(${json.datos[0].id_datos})`);
            } else {
                $("#btn-confirmar").attr("onclick",`actualizardatos(0)`);
            }
            showPage();
            
        }
    });
    
}

function actualizardatos(id){
    document.getElementById('clabe-error').innerHTML = '';
    document.getElementById('numero-error').innerHTML = '';
    document.getElementById('costo-error').innerHTML = '';
    document.getElementById('costo-pronto-error').innerHTML = '';
    var pronto = document.getElementById('pronto').value;
    var costo = document.getElementById('costo').value;
    var costoPronto = document.getElementById('costo-pronto').value;
    var banco = document.getElementById('banco');
	var valor = banco.options[banco.selectedIndex].value;
    var numero = document.getElementById('numero').value;
    var clabe = document.getElementById('clabe').value;
    if(pronto.length > 0 && costo.length > 0 && costoPronto.length > 0 && numero.length > 0 && clabe.length > 0){
        if(numero.length == 16){
            if(clabe.length == 18){
                if(!isNaN(costo)){
                    if(!isNaN(costoPronto)){
                        if(!isNaN(numero)){
                            if(!isNaN(clabe)){
                                $.ajax({
                                    "url" : base_url + "BackEnd/actualizadatos",
                                    "type" : "post",
                                    "data" : {
                                        "id" : id,
                                        "dias" : parseFloat(pronto),
                                        "costo" : parseFloat(costo),
                                        "costo_pronto" : parseFloat(costoPronto),
                                        "banco" : valor,
                                        "numero" : parseInt(numero),
                                        "clabe" : parseInt(clabe) 
                                    },
                                    "dataType" : "json",
                                    "success" : function(json){
                            
                                        if(json.resultado){
                
                                            alertas('Configuración guardada!');
                            
                                            $("#pronto").prop('disabled', true);
                                            $("#costo").prop('disabled', true);
                                            $("#costo-pronto").prop('disabled', true);
                                            $("#banco").prop('disabled', true);
                                            $("#numero").prop('disabled', true);
                                            $("#clabe").prop('disabled', true);
                
                                            $('#btn-confirmar').css('display', 'none');
                
                                            editar = false;
                                            
                                        } else {
                                            alertas('Error inesperado');
                                        }
                                        
                                    }
                                });
                            } else {
                                document.getElementById('clabe-error').innerHTML = 'La CLABE interbancaria debe ser numérica';
                            }
                        } else {
                            document.getElementById('numero-error').innerHTML = 'El número de cuenta debe ser numérico';
                        }
                    } else {
                        document.getElementById('costo-pronto-error').innerHTML = 'El monto debe ser numérico';
                    }
                } else {
                    document.getElementById('costo-error').innerHTML = 'El monto debe ser numérico';
                }
                
            } else {
                document.getElementById('clabe-error').innerHTML = 'Su CLABE interbancaria debe tener 18 dígitos.';
            }
        } else {
            document.getElementById('numero-error').innerHTML = 'Su número de cuenta debe tener 16 dígitos.';
        }
        
    } else {
        alertas('Favor de llenar todos los campos...');
    }
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }