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
			<div class="col-md-4">
			<a href="{{ root }}user/refresh"><span class='glyphicon glyphicon-refresh' style="font-size: 100px" aria-hidden="true"></span></a>
			</div>
			<div class="col-md-4">
			<a href="{{ root }}user/booking"><span class='glyphicon glyphicon-calendar' style="font-size: 100px" aria-hidden="true"></span></a>
			</div>
		</div>	
	{% endif %}
</div>
{% endblock %}