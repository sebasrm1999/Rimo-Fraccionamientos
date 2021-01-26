let base_url = 'http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/';

$(document).ready(function()
{

	var userID = sessionStorage.getItem('id');
		if(userID != null){
		  cargarquejas();
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
});

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function cargarquejas(){
    
	var quejas = document.getElementById('quejas');
	var id = sessionStorage.getItem('area');

    quejas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/quejaxarea",
        "type" : "post",
        "data" : {
            "id_area" : id
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
                ${doc.fecha_estimada != null ? '' : `<button id="btn-fecha-${doc.id_queja}" onclick="fecha(${doc.id_queja})" class="btn py-2 mr-1 btn-outline-info"><i class="fa fa-calendar fa-3x"></i></button>`}
                <button class="btn py-2 mr-1 text-white btn-quejas" onclick="comentarios(${doc.id_queja})"><i class="fa fa-comments fa-3x" style="padding-right: 5px;"></i></button>
                ${doc.status == 4 ? '' : `<button class="btn btn-outline-danger" onclick="cerrarqueja(${doc.id_queja})" >Cerrar Queja</button>`}
                
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

    if(comentario.length > 0){
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

                console.log(id);
    
                if(json.resultado){
    
                    $.ajax({
                        "url" : base_url + "BackEnd/contestarqueja",
                        "type" : "post",
                        "data" : {
                            "id" : id
                        },
                        "dataType" : "json",
                        "success" : function(json2){
                
                            if(json2.resultado){
                
                                comentarios(id);
                                
                            } else {
                                alertas('Ha ocurrido un error');
                            }
                            
                        }
                    });
                    
                } else {
                    alertas('Ha ocurrido un error');
                }
                cargarquejas();
            }
        });
    } else {
        alertas('Favor de escribir el comentario...');
    }
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

            if(json['queja'][0].status == 1){
                $.ajax({
                    "url" : base_url + "BackEnd/leerqueja",
                    "type" : "post",
                    "data" : {
                        "id" : id
                    },
                    "dataType" : "json",
                    "success" : function(json2){
            
                        $('#quejaModal').modal('show');
            
                        $("#btn-confirmar").attr("onclick",`agregarcomentario(${json['queja'][0].id_queja})`);
            
                        document.getElementById('asunto').innerHTML = json['queja'][0].asunto;
                        document.getElementById('user-queja').innerHTML = json['queja'][0].nombre;
                        document.getElementById('descripcion').innerHTML = json['queja'][0].descripcion;
                        document.getElementById('fecha').innerHTML = json['queja'][0].fecha;
                        document.getElementById('hora').innerHTML = json['queja'][0].hora;
            
                        json['comentarios'].forEach(doc => {
            
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
            } else {
                $('#quejaModal').modal('show');
            
                $("#btn-confirmar").attr("onclick",`agregarcomentario(${json['queja'][0].id_queja})`);
    
                document.getElementById('asunto').innerHTML = json['queja'][0].asunto;
                document.getElementById('user-queja').innerHTML = json['queja'][0].nombre;
                document.getElementById('descripcion').innerHTML = json['queja'][0].descripcion;
                document.getElementById('fecha').innerHTML = json['queja'][0].fecha;
                document.getElementById('hora').innerHTML = json['queja'][0].hora;
    
                json['comentarios'].forEach(doc => {
    
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
            cargarquejas();
        }
    });
    
}

function cerrarqueja(id){
    $.ajax({
        "url" : base_url + "BackEnd/cerrarqueja",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            if(json.resultado){

                cargarquejas();
                
            } else {
                alertas('Ha ocurrido un error');
            }
            
        }
    });
}

function actualizarfecha(id){
    var fecha = document.getElementById('fecha-estimada').value;
    $.ajax({
        "url" : base_url + "BackEnd/fechaqueja",
        "type" : "post",
        "data" : {
            "id" : id,
            "fecha" : fecha
        },
        "dataType" : "json",
        "success" : function(json){

            if(json.resultado){

                cargarquejas();
                $('#fechaModal').modal('hide');
                
            } else {
                alertas('Ha ocurrido un error');
            }
            
        }
    });
}

function alertas(alerta){
    $('#alertaModal').modal('show');

    $('#info-modal-cuerpo').html(alerta);
}

function fecha(id){
    $('#fechaModal').modal('show');

    $("#btn-confirmar-fecha").attr("onclick",`actualizarfecha(${id})`);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }