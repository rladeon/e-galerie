{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>

	<!--<h2>Mon compte </h2>-->
	{% if (session.logged_in == null) or (session.logged_in == false) %}
		<div class="row">
			<div class="col-md-4">
			<p>Il faut se connecter pour avoir accès à cet espace</p>
			</div>
			<div class="col-md-4">
			<div class="flex">
						<a href="{{ root }}user/login" class="bttn" >Se connecter</a>
					</div>
			</div>
		</div>	
		{% else %}
			<p>{{welcome}}</p>
			<div class="row">
			<a href="{{ root }}user/refresh"><div class="accountcard col-md-3">
			<i class="fa fa-drivers-license-o" style="font-size: 100px"></i>
			<div class="accountcardcontainer">
				<h4>Mise à jour des infos personnelles</h4> 
				
				</div>
			</div></a>
			<a href="{{ root }}user/reservation"><div class=" accountcard col-md-3">
			<i class="fa fa-calendar" style="font-size: 100px"></i>
			<div class="accountcardcontainer">
				<h4>Liste Réservation </h4> 
				
				</div>
			</div></a>
			<a href="{{ root }}user/forget"><div class="col-md-3 accountcard">
				<i class='fa fa-question-circle-o' style="font-size: 100px" ></i>
				<div class="accountcardcontainer">
				<h4>Mot de passe oublié</h4> 
				
				</div>
			</div></a>
			<a href="{{ root }}user/newpassword"><div class="col-md-3 accountcard">
				<i class='fa fa-refresh' style="font-size: 100px" ></i>
				<div class="accountcardcontainer">
				<h4>Changer de mot de passe</h4> 
				
				</div>
			</div></a>
			
		</div>	
	{% endif %}
</div>
{% endblock %}