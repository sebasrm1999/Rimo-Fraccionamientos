let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

var costo = '';
var costoPronto = '';

paypal.Buttons({
	createOrder: function(data, actions) {
	  return actions.order.create({
		purchase_units: [{
		  amount: {
			value: '0.01'
		  }
		}]
	  });
	},
	onApprove: function(data, actions) {
	  return actions.order.capture().then(function(details) {
		alert('Transaction completed by ' + details.payer.name.given_name);
	  });
	}
  }).render('#paypal-button-container');

$(document).ready(function()
{

    var userID = sessionStorage.getItem('id');
		if(userID != null){
		  datos();
		  pagoanterior();
		  pagoactual();
		} else {
		  sessionStorage.clear();
		  window.location.replace(`${base_url}index.php`);
		}

		$("#btn-pagar").attr("onclick","pagoModal('0')");

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

	$('#btn-paypal').click(function(){
		var visibilidad = $('#paypal-container').css('display');
		if(visibilidad == 'none'){
			$('#paypal-container').css('display', 'block');
		} else {
			$('#paypal-container').css('display', 'none');
		}
		$('#form-pago').css('display', 'none');
	});
});

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function datos(){

	var imagenBanco = document.getElementById('imagen-banco');
	var numero = document.getElementById('numero-cuenta');
	var clabe = document.getElementById('clabe-cuenta');
	imagenBanco.innerHTML = '';
	numero.innerHTML = '';
	clabe.innerHTML = '';

    $.ajax({
        "url" : base_url + "BackEnd/datos",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

			if(esEntero(json.datos[0].costo)){
				costo = json.datos[0].costo+'.00';
			} else {
				costo = json.datos[0].costo+'0';
			}

			if(esEntero(json.datos[0].costo_pronto)){
				costoPronto = json.datos[0].costo_pronto+'.00';
			} else {
				costoPronto = json.datos[0].costo_pronto+'0';
			}
			
			imagenBanco.innerHTML = `<img src="${base_url}static/images/${json.datos[0].banco}.png" style="height: 100px; width: 150px;">`;
			numero.innerHTML = json.datos[0].numero;
			clabe.innerHTML = json.datos[0].clabe;
            
        }
    });
}

function pagoactual(){

	var id = sessionStorage.getItem('id');
	const nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
	"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	];

	const fecha = new Date();

    $.ajax({
        "url" : base_url + "BackEnd/pagoactual",
        "type" : "post",
        "data" : {
			"id_usuario" : id,
			"mes" : nombresMeses[fecha.getMonth()],
			"anio" : fecha.getFullYear()
        },
        "dataType" : "json",
        "success" : function(json){

			$.ajax({
				"url" : base_url + "BackEnd/datos",
				"type" : "get",
				"dataType" : "json",
				"success" : function(json2){
		
					document.getElementById('mes').innerHTML = nombresMeses[fecha.getMonth()];
					document.getElementById('estado').innerHTML = json != null ? 'Pagado' : 'Pendiente';
					if(json == null){
						document.getElementById('estado-pronto').innerHTML = fecha.getDate() <= json2.datos[0].dias ? '- Pronto pago' : '';
						document.getElementById('pronto-status').value = fecha.getDate() <= json2.datos[0].dias ? 1 : 0;
					} else {
						document.getElementById('estado-pronto').innerHTML = '';
						document.getElementById('pronto-status').value = '';
					}

					if($('#estado').text() == 'Pendiente'){
						$('#btn-pagar').css('display', 'block');
						$('#btn-adelantado').css('display', 'none');
					  } else {
						$('#btn-pagar').css('display', 'none'); 
						$('#btn-adelantado').css('display', 'block');
					  }
		
					  showPage();
					
				}
			});
            
        }
    });
}

function pagoanterior(){

	var id = sessionStorage.getItem('id');
	const nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
	"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	];

	const fecha = new Date();

	var mes = fecha.getMonth();
	var anio = fecha.getFullYear();
	var mesBusca = mes-1;

	if(mes == 0){
		mesBusca = 11;
		anio = anio-1;
	}
	console.log(mesBusca);
	console.log(anio);
	$.ajax({
		"url" : base_url + "BackEnd/pagoactual",
		"type" : "post",
		"data" : {
			"id_usuario" : id,
			"mes" : nombresMeses[mesBusca],
			"anio" : anio
		},
		"dataType" : "json",
		"success" : function(json){

			if(json == null){
				$.ajax({
					"url" : base_url + "BackEnd/nuevopago",
					"type" : "post",
					"data" : {
						"id_usuario" : id,
						"mes" : nombresMeses[mesBusca],
						"anio" : anio
					},
					"dataType" : "json",
					"success" : function(json2){
			
						cargartabla();
						
					}
				});
			} else {
				cargartabla();
			}
			
		}
	});

}

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
	var pagos = document.getElementById('pagos');
	var id = sessionStorage.getItem('id');

    pagos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/pagosxusuario",
        "type" : "post",
        "data" : {
            "id_usuario" : id
        },
        "dataType" : "json",
        "success" : function(json){

            json.pagos.forEach(doc => {
                pagos.innerHTML += `<tr>
				<td><button class="btn btn-outline-light text-dark" onclick="pago(${doc.id_pago})">${doc.mes}</button></td>
				<td>${doc.anio}</td>
				<td>${doc.status == 0 ? 'Pendiente' : 'Pagado'}</td>
				<td>${doc.fecha != null ? doc.fecha : '---'}</td>
				<td>${doc.hora != null ? doc.hora : '---'}</td>
				<td>${doc.pronto == 1 ? 'Sí' : 'No'}</td>
				<td>${doc.verificado == 1 ? 'Sí' : 'No'}</td>
				<td>${doc.status == 0 ? `<button id="btn-pagar-${doc.id_pago}" onclick="pagoModal(${doc.id_pago})" class="btn btn-outline-success">Pagar</button>` : ''}</td>
				</tr>`;
            });

            $('#dtBasicExample').DataTable({
                "destroy": true,
                "pagingType": "simple_numbers"
              });
            
        }
    });
}

function pagoModal(id){
    $('#pagoModal').modal('show');
	if(id != 0){
		document.getElementById('id-pago-input').value = id;
		document.getElementById('pronto-status').value = 0;
		document.getElementById('fecha-pago-input').value = 0;
		document.getElementById('total').innerHTML = '$'+costo;
		
	} else {
		document.getElementById('id-pago-input').value = 0;
		document.getElementById('fecha-pago-input').value = 1;
		if(document.getElementById('pronto-status').value == 1){
			document.getElementById('total').innerHTML = '$'+costoPronto;
		} else {
			document.getElementById('total').innerHTML = '$'+costo;
		}
	}

	$('#btn-tarjeta').click(function(){
		document.getElementById('titulo-cuenta').innerHTML = 'Transferir a Cuenta:';
		var visibilidad = $('#form-pago').css('display');
		if(visibilidad == 'none'){
			$('#form-pago').css('display', 'block');
		} else {
			$('#form-pago').css('display', 'none');
		}
		$('#paypal-container').css('display', 'none');

		if(id != 0){
		$("#btn-confirmar").attr("onclick",`subirComprobante(${id}, '1')`);
		
		} else {
			$("#btn-confirmar").attr("onclick",`pagonuevo('1')`);
		}
		
	});

	$('#btn-oxxo').click(function(){
		document.getElementById('titulo-cuenta').innerHTML = 'Depositar a Cuenta:';
		var visibilidad = $('#form-pago').css('display');
		if(visibilidad == 'none'){
			$('#form-pago').css('display', 'block');
		} else {
			$('#form-pago').css('display', 'none');
		}
		$('#paypal-container').css('display', 'none');

		if(id != 0){
		$("#btn-confirmar").attr("onclick",`subirComprobante(${id}, '3')`);
		
		} else {
			$("#btn-confirmar").attr("onclick",`pagonuevo('3')`);
		}
	});
	
}

function adelantadoModal(){
	$('#pagoModal').modal('show');
	document.getElementById('total').innerHTML = '$'+costoPronto;
	document.getElementById('fecha-pago-input').value = 1;

	$('#btn-tarjeta').click(function(){
		document.getElementById('titulo-cuenta').innerHTML = 'Transferir a Cuenta:';
		var visibilidad = $('#form-pago').css('display');
		if(visibilidad == 'none'){
			$('#form-pago').css('display', 'block');
		} else {
			$('#form-pago').css('display', 'none');
		}
		$('#paypal-container').css('display', 'none');

		$("#btn-confirmar").attr("onclick",`pagoadelantado('1')`);
		
	});

	$('#btn-oxxo').click(function(){
		document.getElementById('titulo-cuenta').innerHTML = 'Depositar a Cuenta:';
		var visibilidad = $('#form-pago').css('display');
		if(visibilidad == 'none'){
			$('#form-pago').css('display', 'block');
		} else {
			$('#form-pago').css('display', 'none');
		}
		$('#paypal-container').css('display', 'none');

		$("#btn-confirmar").attr("onclick",`pagoadelantado('3')`);
	});
	
}

function pago(id){

    $.ajax({
        "url" : base_url + "BackEnd/pago",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            $('#detalleModal').modal('show');

            document.getElementById('pago-titulo').innerHTML = `${json[0].mes} ${json[0].anio}`;
            document.getElementById('id-pago').innerHTML = json[0].id_pago;
            document.getElementById('usuario-pago').innerHTML = json[0].nombre;
            document.getElementById('status-pago').innerHTML = json[0].status == 1 ? 'Pagado' : 'Pendiente';

            if(json[0].status == 1){
                if(json[0].tipo == 1){
                    document.getElementById('forma-pago').innerHTML = 'Tarjeta de Crédito/Débito';
                } else if(json[0].tipo == 2){
                    document.getElementById('forma-pago').innerHTML = 'Paypal';
                } else if(json[0].tipo == 3){
                    document.getElementById('forma-pago').innerHTML = 'Oxxo';
                }
                $('#info-pagado').css('display', 'block');
                document.getElementById('fecha-pago').innerHTML = `${json[0].fecha} ${json[0].hora}`;
                document.getElementById('pronto-pago').innerHTML = json[0].pronto == 1 ? 'Sí' : 'No';
            } else {
                $('#info-pagado').css('display', 'none');
            }
            
        }
    });
    
}

function pagar(id){
	$.ajax({
		"url" : base_url + "BackEnd/pagar",
		"type" : "post",
		"data" : {
			"id" : id,
			"tipo" : 1
		},
		"dataType" : "json",
		"success" : function(json){
			if(json.resultado){
				pagoactual();
				cargartabla();
				$('#pagoModal').modal('hide');
			} else {
				alert('Error inesperado');
			}
		}
	});
}

function pagonuevo(tipo){
	var comprobanteLng = document.getElementById('comprobante').value;
	var id = sessionStorage.getItem('id');
	const nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
	"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	];

	const fecha = new Date();

	var mes = fecha.getMonth();
	var anio = fecha.getFullYear();

	if(comprobanteLng.length > 0 ){
        $.ajax({
			"url" : base_url + "BackEnd/nuevopago",
			"type" : "post",
			"data" : {
				"id_usuario" : id,
				"mes" : nombresMeses[mes],
				"anio" : anio
			},
			"dataType" : "json",
			"success" : function(json){
	
				if(json.resultado){
					subirComprobante(json.id, tipo);
				} else {
					alert('Error inesperado al crear el pago...');
				}
				
			}
		});
    } else {
        alert('Debe llenar todos los campos...');
    }

}

function pagoadelantado(tipo){
	var comprobanteLng = document.getElementById('comprobante').value;
	var id = sessionStorage.getItem('id');
	const nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
	"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	];

	$.ajax({
        "url" : base_url + "BackEnd/pagosxusuario",
        "type" : "post",
        "data" : {
            "id_usuario" : id
        },
        "dataType" : "json",
        "success" : function(json){

			var mesBusca = 0;
			var anioBusca = 0;

            json.pagos.forEach(doc => {
                if(anioBusca == doc.anio){
					if(doc.mes == 'Enero'){
						if(mesBusca < 1){
							mesBusca = 1;
						}
					} else if(doc.mes == 'Febrero'){
						if(mesBusca < 2){
							mesBusca = 2;
						}
					} else if(doc.mes == 'Marzo'){
						if(mesBusca < 3){
							mesBusca = 3;
						}
					} else if(doc.mes == 'Abril'){
						if(mesBusca < 4){
							mesBusca = 4;
						}
					} else if(doc.mes == 'Mayo'){
						if(mesBusca < 5){
							mesBusca = 5;
						}
					} else if(doc.mes == 'Junio'){
						if(mesBusca < 6){
							mesBusca = 6;
						}
					} else if(doc.mes == 'Julio'){
						if(mesBusca < 7){
							mesBusca = 7;
						}
					} else if(doc.mes == 'Agosto'){
						if(mesBusca < 8){
							mesBusca = 8;
						}
					} else if(doc.mes == 'Septiembre'){
						if(mesBusca < 9){
							mesBusca = 9;
						}
					} else if(doc.mes == 'Octubre'){
						if(mesBusca < 10){
							mesBusca = 10;
						}
					} else if(doc.mes == 'Noviembre'){
						if(mesBusca < 11){
							mesBusca = 11;
						}
					} else if(doc.mes == 'Diciembre'){
						if(mesBusca < 12){
							mesBusca = 12;
						}
					}
				} else if(anioBusca < doc.anio){
					anioBusca = doc.anio;
					mesBusca = 0;
					if(doc.mes == 'Enero'){
						if(mesBusca < 1){
							mesBusca = 1;
						}
					} else if(doc.mes == 'Febrero'){
						if(mesBusca < 2){
							mesBusca = 2;
						}
					} else if(doc.mes == 'Marzo'){
						if(mesBusca < 3){
							mesBusca = 3;
						}
					} else if(doc.mes == 'Abril'){
						if(mesBusca < 4){
							mesBusca = 4;
						}
					} else if(doc.mes == 'Mayo'){
						if(mesBusca < 5){
							mesBusca = 5;
						}
					} else if(doc.mes == 'Junio'){
						if(mesBusca < 6){
							mesBusca = 6;
						}
					} else if(doc.mes == 'Julio'){
						if(mesBusca < 7){
							mesBusca = 7;
						}
					} else if(doc.mes == 'Agosto'){
						if(mesBusca < 8){
							mesBusca = 8;
						}
					} else if(doc.mes == 'Septiembre'){
						if(mesBusca < 9){
							mesBusca = 9;
						}
					} else if(doc.mes == 'Octubre'){
						if(mesBusca < 10){
							mesBusca = 10;
						}
					} else if(doc.mes == 'Noviembre'){
						if(mesBusca < 11){
							mesBusca = 11;
						}
					} else if(doc.mes == 'Diciembre'){
						if(mesBusca < 12){
							mesBusca = 12;
						}
					}
				}
            });
            if(comprobanteLng.length > 0 ){
				if(mesBusca == 12){
					mesBusca = 0;
					anioBusca++;
				}
				$.ajax({
					"url" : base_url + "BackEnd/nuevopago",
					"type" : "post",
					"data" : {
						"id_usuario" : id,
						"mes" : nombresMeses[mesBusca],
						"anio" : anioBusca
					},
					"dataType" : "json",
					"success" : function(json){
			
						if(json.resultado){
							subirComprobante(json.id, tipo);
						} else {
							alert('Error inesperado al crear el pago...');
						}
						
					}
				});
			} else {
				alert('Debe llenar todos los campos...');
			}
        }
	});
	
	/*

	
	*/
}

function subirComprobante(id, tipo){
	var idUsuario = sessionStorage.getItem('id');
	var comprobante = document.getElementById('comprobante').files[0];
	var comprobanteLng = document.getElementById('comprobante').value;
	
	var pronto = document.getElementById('pronto-status').value;

	if(comprobanteLng.length > 0 ){
		$.ajax({
			"url" : base_url + "BackEnd/pago",
			"type" : "post",
			"data" : {
				"id" : id
			},
			"dataType" : "json",
			"success" : function(json2){
	
				var formData = new FormData();
				formData.append('id', id);
				formData.append('id_usuario', idUsuario);
				formData.append('mes', json2[0].mes);
				formData.append('anio', json2[0].anio);
				formData.append('pronto', pronto);
				formData.append('tipo', tipo);
				formData.append('comprobante', comprobante);

				axios({
					method: 'post',
					url: `${base_url}BackEnd/subirticket`,
					headers: { 'Content-Type': 'multipart/form-data' },
					data: formData,
				}).then(json => {
					console.log(json);
					if (json.data.resultado) {
						if(document.getElementById('fecha-pago-input').value == 1){
							fechapago();
						} else {

							cargartabla();
							pagoactual();
							$('#pagoModal').modal('hide');
							
						}
						
						
					}

					else {
						alert(
							json.data.mensaje
						);
					}
				}).catch(e => {
					alert(
						`Error ${e}`
					);
					console.log(e);
				});
				
			}
		});
        
    } else {
        alert('Debe llenar todos los campos...');
    }

	
}

function fechapago(){
	var id = sessionStorage.getItem('id');

	$.ajax({
		"url" : base_url + "BackEnd/fechausuario",
		"type" : "post",
		"data" : {
			"id" : id
		},
		"dataType" : "json",
		"success" : function(json){
			if(json.resultado){
				pagoactual();
				cargartabla();
				$('#pagoModal').modal('hide');
			} else {
				alert('Error inesperado');
			}
		}
	});
}

function esEntero(numero){
    if (numero - Math.floor(numero) == 0) {
        return true;
    } else {
        return false;
    }
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }