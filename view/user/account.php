{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
	<h2>Mon compte </h2>
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
			<p>accès autorisé</p>
			<div class="row">
			<div class="accountcard col-md-3">
			<a href="{{ root }}user/refresh"><i class="fa fa-drivers-license-o" style="font-size: 100px"></i></a>
			<div class="accountcardcontainer">
				<h4>Mise à jour des infos personnelles</h4> 
				
				</div>
			</div>
			<div class=" accountcard col-md-3">
			<a href="{{ root }}user/reservation"><i class="fa fa-calendar" style="font-size: 100px"></i></a>
			<div class="accountcardcontainer">
				<h4>Liste Réservation </h4> 
				
				</div>
			</div>
			<div class="col-md-3 accountcard">
				<a href="{{ root }}user/forget"><i class='fa fa-question-circle-o' style="font-size: 100px" ></i></a>
				<div class="accountcardcontainer">
				<h4>Mot de passe oublié</h4> 
				
				</div>
			</div>
			<div class="col-md-3 accountcard">
				<a href="{{ root }}user/addresse"><i class='fa fa-home' style="font-size: 100px" ></i></a>
				<div class="accountcardcontainer">
				<h4>Adresse</h4> 
				
				</div>
			</div>
		</div>	
	{% endif %}
</div>
{% endblock %}