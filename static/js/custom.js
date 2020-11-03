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
	cargartabla();

	avisosgenerales();

	/* 

	1. Vars and Inits

	*/

	var header = $('.header');
	var map;

	initMenu();
	initHomeSlider();
	initGoogleMap();
	initTestSlider();

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

	/* 

	4. Init Home Slider

	*/

	function initHomeSlider()
	{
		if($('.home_slider').length)
		{
			var homeSlider = $('.home_slider');
			homeSlider.owlCarousel(
			{
				items:1,
				autoplay:true,
				autoplayTimeout:15000,
				loop:true,
				dots:false,
				nav:false,
				mouseDrag:false,
				smartSpeed:1200
			});

			if($('.home_slider_nav').length)
			{
				var next = $('.home_slider_nav');
				next.on('click', function()
				{
					homeSlider.trigger('next.owl.carousel');
				});
			}

			if($('.home_slider_nav_left').length)
			{
				var prev = $('.home_slider_nav_left');
				prev.on('click', function()
				{
					homeSlider.trigger('prev.owl.carousel');
				});
			}
		}
	}

	/* 

	5. Init Google Map

	*/

	function initGoogleMap()
	{
		var myLatlng = new google.maps.LatLng(40.760836, -73.910357);
    	var mapOptions = 
    	{
    		center: myLatlng,
	       	zoom: 14,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			draggable: true,
			scrollwheel: false,
			zoomControl: false,
			zoomControlOptions:
			{
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			rotateControl: false,
			fullscreenControl: false,
			styles:
			[
			  {
			    "featureType": "road.highway",
			    "elementType": "geometry.fill",
			    "stylers": [
			      {
			        "color": "#ffeba1"
			      }
			    ]
			  }
			]
    	}

    	// Initialize a map with options
    	map = new google.maps.Map(document.getElementById('map'), mapOptions);

		// Re-center map after window resize
		google.maps.event.addDomListener(window, 'resize', function()
		{
			setTimeout(function()
			{
				google.maps.event.trigger(map, "resize");
				map.setCenter(myLatlng);
			}, 1400);
		});

		function newLocation(newLat, newLng)
		{
			map.setCenter(
			{
				lat : newLat,
				lng : newLng
			});
		}

		var locationList = $('.location_contaner');
		locationList.each(function()
		{
			var loc = $(this);
			loc.on('click', function()
			{
				var newLat = loc.data('lat');
				var newLng = loc.data('lng');
				newLocation(newLat, newLng);
			});
				
		});
	}

	/* 

	6. Init Testimonials Slider

	*/

	function initTestSlider()
	{
		if($('.test_slider').length)
		{
			var testSlider = $('.test_slider');
			testSlider.owlCarousel(
			{
				items:1,
				autoplay:true,
				autoplayHoverPause:true,
				loop:true,
				nav:false,
				dots:true,
				smartSpeed:1200
			});
		}
	}

});

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function cargartabla(){

    $('#dtBasicExample').DataTable().clear().destroy();
    
	var avisos = document.getElementById('avisosPersonales');
	var id = sessionStorage.getItem('id');

    avisos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/avisopersonal",
        "type" : "post",
        "data" : {
            "id_usuario" : id
        },
        "dataType" : "json",
        "success" : function(json){

            json.avisos.forEach(doc => {
                avisos.innerHTML += `<tr>
				<td><button class="btn btn-outline-light text-dark" onclick="aviso(${doc.id_aviso})">${doc.asunto}</button></td>
				<td>${doc.fecha}</td>
                <td>${doc.hora}</td>
				</tr>`;
            });

            $('#dtBasicExample').DataTable({
                "destroy": true,
                "pagingType": "simple_numbers"
              });
            
        }
    });
}

function avisosgenerales(){
	var avisos = document.getElementById('avisosGenerales');

    avisos.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/avisos",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

			var contador = 0;
            json.avisos.forEach(doc => {
				if(doc.tipo == 1){
					var activo = '';
					if(contador === 0){
					activo = 'active';
					} else {
					activo = '';
					}
					avisos.innerHTML += `<div class="carousel-item ${activo}">
					<div class="background_image" style="background-image:url(${base_url}static/images/index.jpg)"></div>
					<div class="home_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content rounded my-4">
										<div class="home_title"><h1>${doc.asunto}</h1></div>
										<div class="home_description"><p>${doc.descripcion}</p></div>
										<div class="d-flex flex-wrap align-content-end float-right">${doc.fecha} ${doc.hora}</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>`;
				contador++;
				}
                
            });
            
        }
    });
}

function aviso(id){

    $.ajax({
        "url" : base_url + "BackEnd/aviso",
        "type" : "post",
        "data" : {
            "id" : id
        },
        "dataType" : "json",
        "success" : function(json){

            $('#avisoModal').modal('show');

            document.getElementById('aviso-titulo').innerHTML = json[0].asunto;
            document.getElementById('descripcion').innerHTML = json[0].descripcion;
            
        }
    });
    
}