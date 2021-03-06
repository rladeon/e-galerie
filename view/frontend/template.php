<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>{{ title }}</title>
        <meta name="viewport" content="width=device-width" />		
		<link rel="stylesheet" href="{{ root }}public/css/layout.css">	
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="{{ root }}public/css/skdslider.css" rel="stylesheet">
		<link rel="stylesheet" href="{{ root }}public/css/smartphoto.min.css">
		<link rel="stylesheet" href="{{ root }}public/css/justifiedGallery.min.css" />
		<link href="{{ root }}public/css/style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{ root }}public/css/jquery-eu-cookie-law-popup.css"/>
		<script src="https://www.google.com/recaptcha/api.js"></script>
    </head>
    <body>
	<div>
      <header id="header" class="main-header">
			<div class="header-inner">
		 
				<div class="header-logo">
					<!--<img src="{{ root }}public/images/logo.png" alt="Creative Juiz" width="150" height="45">-->
					<span class="logo-inc">Galerie Christ 'l</span>
				</div>
		 
				<nav class="header-nav">
					<ul>
						<li><a href="{{ root }}">Accueil</a></li>
						<li><a href="{{ root }}about/index">Présentation</a></li>
						<li><a href="{{ root }}gallery/index">Galerie photo</a></li>
						<li><a href="{{ root }}exposure/index">Expositions</a></li>
						<li><a href="{{ root }}book/show/page/christiane-ladeon-l-endometriose-de-l-ombre-a-la-lumiere">Livre</a></li>
						<li><a href="{{ root }}press/index">Presse</a></li>
						<li><a href="{{ root }}contact/index">Contact</a></li>
						<li><a href="{{ root }}user/account">Mon compte</a></li>
						{% if (session.logged_in != null) and (session.logged_in == true) %}
							<li >
						   	  <a href="{{ root }}user/logout"><span class='glyphicon glyphicon-off' aria-hidden="true"></span></a>
							</li>
							
						{% endif %}
					</ul>
				</nav>
		 
			</div>
	
		</header>
      <div class="topnav" id="myTopnav">
		  <a href="{{ root }}" class="active">Accueil</a>
		  <a href="{{ root }}about/index">Présentation</a>
		  <a href="{{ root }}gallery/index">Galerie photo</a>
		  <a href="{{ root }}exposure/index">Expositions</a>
		  <a href="{{ root }}book/show/page/christiane-ladeon-l-endometriose-de-l-ombre-a-la-lumiere">Livre</a>
		  <a href="{{ root }}press/index">Presse</a>
		  <a href="{{ root }}contact/index">Contact</a>
		  <a href="{{ root }}user/account">Mon compte </a>
		  {% if (session.logged_in != null) and (session.logged_in == true) %}
								
		  <a href="{{ root }}user/logout"><span class='glyphicon glyphicon-off' aria-hidden="true"></span></a>
		 {% endif %}
		  
		  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
			<i class="fa fa-bars"></i>
		  </a>
		</div>


	  </div>
	  <!-- RGPD pop up -->
	  <div class="eupopup eupopup-container eupopup-container-block">
  <div class="eupopup-markup">
    <div class="eupopup-head">Ce site utilise des cookies</div>
    <div class="eupopup-body">Nous utilisons des cookies pour vous garantir la meilleure expérience sur notre site. Si vous continuez à utiliser le site, nous supposerons que vous accepter tous les cookies sur ce site.</div>
    <div class="eupopup-buttons">
      <a href="#" class="eupopup-button eupopup-button_1">Continuer</a>
      
    </div>
    <div class="clearfix"></div>
    <a href="#" class="eupopup-closebutton">x</a>
  </div>
</div>
<!-- fin RGPD -->
		<div>
			{% block content %}{% endblock %}
		</div>
		<!-- FOOTER -->
      <footer class="sticky-footer">
        <div class="container">
			<p>&copy; 2018 Christiane Ladéon &middot; <a href="{{root}}content/cgu">CGU</a> &middot; <a href="{{root}}content/legitmention">mentions légales</a></p>
		</div>
      </footer> 
	  <script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
		
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="{{ root }}public/js/skdslider.min.js"></script>
	<script type="text/javascript" src="{{ root }}public/js/jquery.mixitup.min.js"></script>
	<script src="{{ root }}public/js/jquery-smartphoto.min.js"></script>
	<script src="{{ root }}public/js/jquery.justifiedGallery.min.js"></script>
	<script src="{{ root }}public/js/form.js"></script>
	<script src="{{ root }}public/js/jquery-eu-cookie-law-popup.js"></script>
	<!--Banner-->
	<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo1').skdslider({
          slideSelector: '.slide',
          delay:5000,
          animationSpeed:2000,
          showNextPrev:true,
          showPlayButton:true,
          autoSlide:true,
          animationType:'fading'
        });

        jQuery('#demo2').skdslider({
          slideSelector: '.slide',
          delay:5000, 
          animationSpeed: 1000,
          showNextPrev:true,
          showPlayButton:false,
          autoSlide:true,
          animationType:'sliding'
        });
    });
</script>
<!--Portfolio-->
<script type="text/javascript">
	$(function () {
		
		var filterList = {
		
			init: function () {
			
				// MixItUp plugin
				// http://mixitup.io
				$('#portfoliolist').mixItUp({
  				selectors: {
    			  target: '.portfolio',
    			  filter: '.filter'	
    		  },
    		  load: {
      		  filter: '.fruit'  
      		}     
				});								
			
			}

		};
		
		// Run the show!
		filterList.init();
		
		
	});	
	</script>
	<!--LightBox-->
	<script>
	$(function(){
		$(".js-smartPhoto").SmartPhoto();
		});
		</script>
		<!--Switch Big images and thumbnails-->
		<script>
		$(function(){
    $("#big-image img:eq(0)").show();
    $("#small-images").on('click','a',function(e){
		
        var index = $(this).index();
        $("#big-image img").eq(index).show().siblings().hide();
    });
});
		</script>
		<!--Galerie-->
		<script>
			$("#mygallery").justifiedGallery();
		</script>
    </body>
</html>