let base_url = 'http://localhost/myhome_ci/';

$(document).ready(function()
{

	preguntas();

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
});

function cerrar(){
    sessionStorage.clear();

    window.location.replace(`${base_url}index.php`);
}

function preguntas(){
    
	var preguntas = document.getElementById('preguntas');

    preguntas.innerHTML= '';
    
    $.ajax({
        "url" : base_url + "BackEnd/preguntas",
        "type" : "get",
        "dataType" : "json",
        "success" : function(json){

            json.preguntas.forEach(doc => {
                preguntas.innerHTML += `
				
				<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center rounded mt-3">
		
				<div class="mb-4 mb-md-0 mr-5">
		
					<div class=" d-flex align-items-center">
					<h2 class="mr-3 text-black h3">${doc.asunto}</h2>
					</div>
					<div class=" d-block d-md-flex">
					<div class="mr-3">${doc.descripcion}</div>
					</div>
				</div>
				</div>`;
            });
            
        }
    });
}