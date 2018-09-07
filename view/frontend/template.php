<!DOCTYPE html>
<html>
    <head>
        <title>{{ title }}</title>
        <meta name="viewport" content="width=device-width" />
		
		<!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ root }}public/css/skdslider.css" rel="stylesheet">
	<link href="{{ root }}public/css/style.css" rel="stylesheet">
    </head>
    <body>
	<div>
      <header id="header" role="banner" class="main-header">
			<div class="header-inner">
		 
				<div class="header-logo">
					<img src="{{ root }}public/images/logo.png" alt="Creative Juiz" width="150" height="45">
				</div>
		 
				<nav class="header-nav">
					<ul>
						<li><a href="{{ root }}">Accueil</a></li>
						<li><a href="#">Présentation</a></li>
						<li><a href="#">Galerie photo</a></li>
						<li><a href="#">Expositions</a></li>
						<li><a href="{{ root }}book/show/page/christiane-ladeon-l-endometriose-de-l-ombre-a-la-lumiere">Livre</a></li>
						<li><a href="#">Presse</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</nav>
		 
			</div>
	
		</header>
      <div class="topnav" id="myTopnav">
  <a href="#home" class="active">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
</div>
{% block content %}{% endblock %}
	  
		
		<!-- FOOTER -->
      <footer class="sticky-footer">
        <div class="center-text">
			<p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
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
    </body>
</html>